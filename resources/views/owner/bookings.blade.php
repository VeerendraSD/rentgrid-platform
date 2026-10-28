<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings | RentGrid Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #059669;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --border: #e2e8f0;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-main); color: var(--text-dark); margin: 0; padding-bottom: 40px; }
        .navbar { background: white; border-bottom: 1px solid var(--border); padding: 0 40px; height: 72px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .nav-links { display: flex; gap: 32px; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--text-muted); font-weight: 600; font-size: 14px; transition: color 0.2s; }
        .nav-links a.active { color: var(--primary); }
        .nav-links a:hover { color: var(--primary); }

        .main-content { padding: 40px; max-width: 1200px; margin: 0 auto; }

        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        h1 { font-size: 24px; font-weight: 800; }

        .table-card { background: white; border-radius: 16px; border: 1px solid var(--border); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f1f5f9; text-align: left; padding: 16px; font-size: 12px; color: var(--text-muted); text-transform: uppercase; }
        td { padding: 16px; border-top: 1px solid var(--border); font-size: 14px; }

        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: capitalize; }
        .badge-held { background: #fffbeb; color: #92400e; }
        .badge-confirmed { background: #ecfdf5; color: #065f46; }
        .badge-rejected { background: #fef2f2; color: #991b1b; }

        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; }
        .btn-confirm { background: var(--primary); color: white; }
        .btn-reject { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

<div class="navbar">
    <h2 style="color:var(--primary); margin: 0; font-size: 22px; font-weight: 800;">RentGrid</h2>
    <nav class="nav-links">
        <a href="{{ route('dashboard') }}">Overview</a>
        <a href="{{ route('dashboard.bookings') }}" class="active">Manage Bookings</a>
        <a href="{{ route('marketplace.index') }}">View Marketplace</a>
    </nav>
</div>

<div class="main-content">
    <div class="header">
        <h1>Manage Bookings</h1>
    </div>

    @if (session('success'))
        <div style="padding: 16px; background: #ecfdf5; color: #065f46; border-radius: 8px; margin-bottom: 20px;">{{ session('success') }}</div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Booking</th>
                    <th>Customer</th>
                    <th>Equipment</th>
                    <th>Dates</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>#{{ $booking->id }}</td>
                    <td><strong>{{ $booking->customer_name }}</strong><br><small>{{ $booking->customer_email }}</small></td>
                    <td>{{ $booking->item->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}</td>
                    <td>₹{{ number_format((float) $booking->total_price, 2) }}</td>
                    <td><span class="badge badge-{{ $booking->status }}">{{ $booking->status }}</span></td>
                    <td>
                        @if ($booking->status === 'held')
                            <form method="POST" action="{{ route('dashboard.bookings.update', $booking) }}" style="display:inline;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button class="btn-action btn-confirm">Confirm</button>
                            </form>
                            <form method="POST" action="{{ route('dashboard.bookings.update', $booking) }}" style="display:inline;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button class="btn-action btn-reject">Reject</button>
                            </form>
                        @else
                            —
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
