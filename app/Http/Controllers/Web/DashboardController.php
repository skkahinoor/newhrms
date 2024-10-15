<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\FollowUp;
use App\Models\FollowUpSetting;
use App\Models\LeadAgent;
use App\Models\Role;
use App\Models\User;
use App\Repositories\DashboardRepository;
use App\Services\Client\ClientService;
use App\Services\Project\ProjectService;
use App\Services\Task\TaskService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private DashboardRepository $dashboardRepo;
    private ClientService $clientService;
    private TaskService $taskService;
    private ProjectService $projectService;

    public function __construct(
        DashboardRepository $dashboardRepo,
        ClientService $clientService,
        TaskService $taskService,
        ProjectService $projectService
    ) {
        $this->dashboardRepo = $dashboardRepo;
        $this->clientService = $clientService;
        $this->projectService = $projectService;
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {

        try {
            // Get current date and date 2 days from now

            // check use is admin or not
            $role = Role::all();
            $admin = User::where('role_id', $role);
            $user = Auth::user();

            // Check If the user is Admin Or Not
            if (auth()->user()->role_id == $user->id) { // This is Admin
                $isAdmin = true;
                $Followupsetting = FollowUpSetting::first();
                $notifydays = $Followupsetting ? $Followupsetting->notifyday : 2;
                $currentDate = Carbon::now();
                $upcomingDate = Carbon::now()->addDays($notifydays);
                $followup = FollowUp::with('leadEnquery')
                    ->whereBetween('followupdate', [$currentDate->toDateString(), $upcomingDate->toDateString()])
                    ->orderBy('followupdate', 'asc')->get();
                $groupedFollowups = $followup->groupBy(function ($item) {
                    return $item->followupdate;
                });
            } else { // This is user
                $isAdmin = false;

                $Followupsetting = FollowUpSetting::first();
                $notifydays = $Followupsetting ? $Followupsetting->notifyday : 2;
                $currentDate = Carbon::now();
                $upcomingDate = Carbon::now()->addDays($notifydays);

                $leadAgent = LeadAgent::where('userid', $user->id)->first();

                if ($leadAgent) {
                    // Retrieve follow-ups related to the leads that this lead agent is assigned to
                    $followup = FollowUp::whereHas('leadEnquery.leadAgent', function ($query) use ($leadAgent) {
                        $query->where('id', $leadAgent->id); // Filter by the current lead agent's ID
                    })
                        ->with('leadEnquery') // Load related LeadEnquery data
                        ->whereBetween('followupdate', [$currentDate->toDateString(), $upcomingDate->toDateString()])
                        ->orderBy('followupdate', 'asc')
                        ->get();
                    // Group follow-ups by the follow-up date
                    $groupedFollowups = $followup->groupBy(fn($item) => $item->followupdate);
                } else {
                    $followup = collect();
                    $groupedFollowups = collect();
                }
            }
            // top are my code

            $appTimeSetting = AppHelper::check24HoursTimeAppSetting();

            $projectSelect = ['id', 'name', 'start_date', 'deadline', 'status', 'priority'];
            $withProject = [
                'projectLeaders.user:id,name,avatar',
                'tasks:id,project_id',
                'completedTask:id,project_id',
            ];
            $companyId = AppHelper::getAuthUserCompanyId();
            $branchId = auth()->user()->branch_id;
            if (!$companyId) {
                throw new Exception('Company Detail Not Found');
            }
            $date = AppHelper::yearDetailToFilterData();

            if ($branchId == null) {
                $dashboardDetail = $this->dashboardRepo->getCompanyDashboardDetail($companyId, $date);
            } else {
                $dashboardDetail = $this->dashboardRepo->getCompanyDashboardDetail($companyId, $date, $branchId);
            }

            $topClients = $this->clientService->getTopClientsOfCompany();
            $taskPieChartData = $this->taskService->getTaskDataForPieChart();
            $projectCardDetail = $this->projectService->getProjectCardData();
            $recentProjects = $this->projectService->getRecentProjectListsForDashboard($projectSelect, $withProject);

            return view(
                'admin.dashboard',
                compact(
                    'dashboardDetail',
                    'topClients',
                    'taskPieChartData',
                    'projectCardDetail',
                    'recentProjects',
                    'appTimeSetting',
                    'followup',
                    'groupedFollowups',
                    'notifydays',
                    'isAdmin',
                    'currentDate'
                )
            );
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('danger', $exception->getMessage());
        }
    }

    // fetch follow up details and show as Json
    public function showFollowUps()
    {
        $today = now()->toDateString();
        $followUps = FollowUp::whereDate('followupdate', $today)->with('leadEnqueryforDashboard')->get();
        return response()->json(['data' => $followUps]);
    }

}
