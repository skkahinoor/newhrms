<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f7f7f7;
        }

        .invoice-box {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #eee;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-details div {
            width: 48%;
        }

        .invoice-details h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .invoice-details p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th, .invoice-table td {
            padding: 10px;
            border: 1px solid #eee;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .invoice-summary {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .invoice-summary div {
            width: 50%;
        }

        .invoice-summary table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-summary th, .invoice-summary td {
            padding: 10px;
            text-align: right;
            border: 1px solid #eee;
        }

        .invoice-summary th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .invoice-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .invoice-footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="invoice-box">
        <div class="invoice-header">
            <img src="https://via.placeholder.com/150" alt="Company Logo">
            <h1>Invoice</h1>
        </div>

        <div class="invoice-details">
            <div class="company-details">
                <h3>Company Name</h3>
                <p>1234 Street Name<br>
                City, State, Zip Code<br>
                Phone: (123) 456-7890<br>
                Email: info@company.com</p>
            </div>
            <div class="customer-details">
                <h3>Billing To</h3>
                <p>John Doe<br>
                5678 Another Street<br>
                Another City, Another State 98765<br>
                Phone: (987) 654-3210<br>
                Email: john.doe@example.com</p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Product 1</td>
                    <td>2</td>
                    <td>$25.00</td>
                    <td>$50.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Product 2</td>
                    <td>1</td>
                    <td>$15.00</td>
                    <td>$15.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Product 3</td>
                    <td>3</td>
                    <td>$10.00</td>
                    <td>$30.00</td>
                </tr>
            </tbody>
        </table>

        <div class="invoice-summary">
            <div>
                <table>
                    <tr>
                        <th>Subtotal:</th>
                        <td>$95.00</td>
                    </tr>
                    <tr>
                        <th>Tax (10%):</th>
                        <td>$9.50</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>$104.50</td>
                    </tr>
                    <tr>
                        <th>Amount Paid:</th>
                        <td>$30.00</td>
                    </tr>
                    <tr>
                        <th>Balance Due:</th>
                        <td>$74.50</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="invoice-footer">
            <p>Thank you for your business!</p>
            <p>Payment is due within 30 days.</p>
            <p>If you have any questions about this invoice, please contact us at info@company.com.</p>
        </div>
    </div>

</body>
</html>
