<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Imports\HolidaysImport;
use App\Models\Branch;
use App\Models\Role;
use App\Requests\Holiday\HolidayRequest;
use App\Services\Holiday\HolidayService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HolidayController extends Controller
{
    private $view = 'admin.holiday.';

    private HolidayService $holidayService;

    public function __construct(HolidayService $holidayService)
    {
        $this->holidayService = $holidayService;
    }

    public function index(Request $request)
    {
        $this->authorize('list_holiday');
        try {
            // new code
            // Get the user's branch_id
            $userBranchId = auth()->user()->branch_id;
            // end code
            $filterParameters['event_year'] = $request->event_year ?? Carbon::now()->format('Y');
            $filterParameters['event'] = $request->event ?? null;
            $filterParameters['month'] = $request->month ?? null;
            // new Code for check admin and user and display according the list
            $currentUser = Auth::user();
            $roleAdminId = Role::where('slug', 'admin')->value('id');
            $admin = $currentUser->role_id == $roleAdminId;
            if (!$admin) {
                $filterParameters['branch_id'] = $userBranchId;
            }
            // end new code
            if (AppHelper::ifDateInBsEnabled()) {
                $nepaliDate = AppHelper::getCurrentNepaliYearMonth();
                $filterParameters['event_year'] = $request->event_year ?? $nepaliDate['year'];
            }
            $months = AppHelper::MONTHS;
            $select = ['id', 'event', 'event_date', 'is_active'];
            $holidays = $this->holidayService->getAllHolidayLists($filterParameters, $select);
            return view($this->view . 'index', compact('holidays',
                'filterParameters',
                'months'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create(): Factory | View | RedirectResponse | Application
    {
        $this->authorize('create_holiday');
        try {
            $branches = Branch::all();
            return view($this->view . 'create', compact('branches'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function store(HolidayRequest $request): RedirectResponse
    {
        $this->authorize('create_holiday');
        try {
            $validatedData = $request->validated();
            $validatedData['branch_id'] = $request->input('branch_id');
            DB::beginTransaction();
            $this->holidayService->store($validatedData);
            DB::commit();
            return redirect()->route('admin.holidays.index')->with('success', 'New Holiday Detail Added Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $this->authorize('show_holiday');
            $holiday = $this->holidayService->findHolidayDetailById($id);
            $branch = Branch::find($holiday->branch_id);
            $holiday->event_date = AppHelper::formatDateForView($holiday->event_date);
            return response()->json([
                'data' => [
                    'event' => $holiday->event,
                    'event_date' => $holiday->event_date,
                    'branch_name' => $branch->name,
                    'note' => $holiday->note,
                ],
            ]);
        } catch (Exception $exception) {
            return AppHelper::sendErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }

    public function edit($id): Factory | View | RedirectResponse | Application
    {
        $this->authorize('edit_holiday');
        try {
            $branches = Branch::all();
            $holidayDetail = $this->holidayService->findHolidayDetailById($id);
            if (AppHelper::ifDateInBsEnabled()) {
                $holidayDetail['event_date'] = AppHelper::dateInYmdFormatEngToNep($holidayDetail['event_date']);
            }
            return view($this->view . 'edit', compact('holidayDetail', 'branches'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(HolidayRequest $request, $id): RedirectResponse
    {
        $this->authorize('edit_holiday');
        try {
            $validatedData = $request->validated();
            $this->holidayService->update($validatedData, $id);
            return redirect()->route('admin.holidays.index')->with('success', 'Holiday Detail Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())
                ->withInput();
        }
    }

    public function toggleStatus($id): RedirectResponse
    {
        $this->authorize('edit_holiday');
        try {
            $this->holidayService->toggleHolidayStatus($id);
            return redirect()->back()->with('success', 'Holiday Status Changed  Successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id): RedirectResponse
    {
        $this->authorize('delete_holiday');
        try {
            $this->holidayService->delete($id);
            return redirect()->back()->with('success', 'Holiday Removed Successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function holidayImport(): Factory | View | Application
    {
        $this->authorize('import_holiday');
        return view($this->view . 'importHolidays');
    }

    public function importHolidays(Request $request)
    {
        $this->authorize('import_holiday');
        try {
            $validate = $request->validate([
                'file' => 'required|file|mimes:csv,txt',
            ]);
            $holidayCSV = $request->file;
            $handle = fopen($holidayCSV, "r");
            $header = fgetcsv($handle, 0, ',');
            $countheader = count($header);
            if ($countheader < 5 && in_array('event', $header) && in_array('event_date', $header) && in_array('note', $header)) {
                Excel::import(new HolidaysImport, $holidayCSV);
                return redirect()->route('admin.holidays.index')->with('success', 'Holidays Detail Imported Successfully');
            } else {
                return redirect()->route('admin.holidays.index')->with('danger', 'Your CSV files having unmatched Columns to our database. Your columns must be in this sequence  event, event_date, note and is_public_holiday only');
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
