<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Invoice – {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; color: #1a1c19; font-size: 13px; background: #fff; position: relative; }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-35deg);
            font-size: 72px;
            font-weight: 900;
            color: rgba(46, 125, 50, 0.06);
            white-space: nowrap;
            letter-spacing: 6px;
            z-index: 0;
            pointer-events: none;
        }

        .page { padding: 50px; position: relative; z-index: 1; }

        /* Header */
        .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; padding-bottom: 24px; border-bottom: 2px solid #2E7D32; }
        .brand { display: flex; align-items: center; gap: 10px; }
        .brand-icon { width: 38px; height: 38px; background: #2E7D32; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .brand-icon span { color: white; font-size: 22px; font-weight: 900; }
        .brand-name { font-size: 26px; font-weight: 900; letter-spacing: -1px; color: #1a1c19; }
        .brand-name em { color: #2E7D32; font-style: normal; }
        .brand-tagline { font-size: 10px; color: #73796E; margin-top: 2px; text-transform: uppercase; letter-spacing: 2px; }

        .invoice-meta { text-align: right; }
        .invoice-title { font-size: 28px; font-weight: 900; color: #2E7D32; letter-spacing: -1px; }
        .invoice-number { font-size: 12px; color: #73796E; margin-top: 4px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .invoice-date { font-size: 11px; color: #73796E; margin-top: 2px; }

        /* Parties */
        .parties { display: flex; justify-content: space-between; margin-bottom: 36px; gap: 20px; }
        .party { background: #f9f9f6; border-radius: 12px; padding: 20px; flex: 1; border-left: 4px solid #2E7D32; }
        .party-label { font-size: 9px; font-weight: 900; color: #2E7D32; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; }
        .party-name { font-size: 15px; font-weight: 900; color: #1a1c19; }
        .party-detail { font-size: 11px; color: #73796E; margin-top: 3px; }

        /* Table */
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 32px; }
        .items-table thead tr { background: #2E7D32; color: white; }
        .items-table th { padding: 12px 16px; text-align: left; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .items-table th:last-child { text-align: right; }
        .items-table td { padding: 12px 16px; border-bottom: 1px solid #e8e8e5; font-size: 12px; vertical-align: middle; }
        .items-table td:last-child { text-align: right; font-weight: 700; }
        .items-table tr:nth-child(even) { background: #fafafa; }
        .item-name { font-weight: 700; color: #1a1c19; }
        .item-detail { font-size: 10px; color: #73796E; margin-top: 2px; }

        /* Totals */
        .totals-section { display: flex; justify-content: flex-end; margin-bottom: 36px; }
        .totals-box { background: #f9f9f6; border-radius: 12px; padding: 20px; min-width: 260px; }
        .total-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 12px; color: #73796E; }
        .total-row.grand { border-top: 2px solid #2E7D32; margin-top: 10px; padding-top: 12px; font-size: 16px; font-weight: 900; color: #1a1c19; }
        .total-row.grand span:last-child { color: #2E7D32; }

        /* Status Badge */
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; background: #dcfce7; color: #2E7D32; }

        /* Footer */
        .footer { border-top: 1px solid #e8e8e5; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; }
        .footer-note { font-size: 10px; color: #73796E; line-height: 1.6; }
        .footer-brand { font-size: 11px; font-weight: 900; color: #2E7D32; }

        /* Tracking info */
        .tracking-box { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 14px 20px; margin-bottom: 32px; display: flex; justify-content: space-between; align-items: center; }
        .tracking-label { font-size: 9px; color: #2E7D32; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; }
        .tracking-value { font-size: 13px; font-weight: 900; color: #1a1c19; margin-top: 3px; }
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">FarmDirect</div>

    <div class="page">
        <!-- Header -->
        <div class="header">
            <div>
                <div class="brand">
                    <div class="brand-icon"><span>F</span></div>
                    <div>
                        <div class="brand-name">Farm<em>Direct</em></div>
                        <div class="brand-tagline">Cultivating Digital Transparency</div>
                    </div>
                </div>
            </div>
            <div class="invoice-meta">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">#{{ $order->order_number }}</div>
                <div class="invoice-date">Issued: {{ $order->created_at->format('d M Y') }}</div>
                <div style="margin-top: 8px">
                    <span class="status-badge">{{ ucfirst($order->status) }}</span>
                </div>
            </div>
        </div>

        <!-- Bill To / Bill From -->
        <div class="parties">
            <div class="party">
                <div class="party-label">Bill To (Buyer)</div>
                <div class="party-name">{{ $buyer->name ?? 'Unknown Buyer' }}</div>
                <div class="party-detail">{{ $buyer->email ?? '' }}</div>
                @if(isset($buyer->phone))<div class="party-detail">{{ $buyer->phone }}</div>@endif
                @if(isset($buyer->city))<div class="party-detail">{{ $buyer->city }}</div>@endif
            </div>
            <div class="party">
                <div class="party-label">Supplied By (Farmer)</div>
                <div class="party-name">{{ $farmer->name ?? 'FarmDirect Partner' }}</div>
                <div class="party-detail">{{ $farmer->email ?? '' }}</div>
                @if(isset($farmer->city))<div class="party-detail">{{ $farmer->city }}</div>@endif
                <div class="party-detail" style="margin-top: 6px; color: #2E7D32; font-weight: 700;">✓ Verified Farmer</div>
            </div>
        </div>

        <!-- Tracking Info -->
        <div class="tracking-box">
            <div>
                <div class="tracking-label">Tracking Number</div>
                <div class="tracking-value">{{ $order->tracking_number ?? 'N/A' }}</div>
            </div>
            <div>
                <div class="tracking-label">Payment Status</div>
                <div class="tracking-value">{{ ucfirst($order->payment_status ?? 'Paid') }}</div>
            </div>
            <div>
                <div class="tracking-label">Order Date</div>
                <div class="tracking-value">{{ $order->created_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Crop / Product</th>
                    <th>Quantity</th>
                    <th>Unit Price (₹)</th>
                    <th>Subtotal (₹)</th>
                </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach($order->items ?? [] as $item)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>
                        <div class="item-name">{{ $item['name'] ?? 'Crop Item' }}</div>
                        <div class="item-detail">Category: Agricultural Produce • Direct Farm Supply</div>
                    </td>
                    <td>{{ $item['quantity'] ?? 0 }} {{ $item['unit'] ?? 'kg' }}</td>
                    <td>₹{{ number_format($item['price'] ?? 0, 2) }}</td>
                    <td>₹{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0), 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <div class="totals-box">
                <div class="total-row"><span>Subtotal</span><span>₹{{ number_format($order->total_price ?? 0, 2) }}</span></div>
                <div class="total-row"><span>Platform Fee (0%)</span><span>₹0.00</span></div>
                <div class="total-row"><span>GST / Tax</span><span>Incl.</span></div>
                <div class="total-row grand"><span>Total Paid</span><span>₹{{ number_format($order->total_price ?? 0, 2) }}</span></div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-note">
                Thank you for choosing FarmDirect.<br>
                This is a computer-generated invoice. No signature required.<br>
                For disputes, contact support@farmdirect.in
            </div>
            <div class="footer-brand">FarmDirect © {{ date('Y') }}</div>
        </div>
    </div>
</body>
</html>
