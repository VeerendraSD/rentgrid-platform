<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RentGrid Admin</title>
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

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: white; padding: 24px; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .stat-card p { font-size: 13px; color: var(--text-muted); margin-bottom: 8px; }
        .stat-card h3 { font-size: 28px; font-weight: 800; color: var(--text-dark); }

        .table-card { background: white; border-radius: 16px; border: 1px solid var(--border); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f1f5f9; text-align: left; padding: 16px; font-size: 12px; color: var(--text-muted); text-transform: uppercase; }
        td { padding: 16px; border-top: 1px solid var(--border); font-size: 14px; }

        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .badge-held { background: #fffbeb; color: #92400e; }
        .badge-confirmed { background: #ecfdf5; color: #065f46; }

        .btn-link { display: inline-block; background: var(--primary); color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
<div class="navbar">
    <h2 style="color:var(--primary); margin: 0; font-size: 22px; font-weight: 800;">RentGrid</h2>
    <nav class="nav-links">
        <a href="{{ route('dashboard') }}" class="active">Overview</a>
        <a href="{{ route('dashboard.bookings') }}">Manage Bookings</a>
        <a href="{{ route('marketplace.index') }}">View Marketplace</a>
    </nav>
</div>

<div class="main-content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <a href="{{ route('dashboard.bookings') }}" class="btn-link">View All Bookings</a>
        </div>

        <div class="stats-grid">
            <div class="stat-card"><p>Total Equipment</p><h3>{{ $totalEquipment }}</h3></div>
            <div class="stat-card"><p>Active Units</p><h3>{{ $activeUnits }}</h3></div>
            <div class="stat-card"><p>Total Bookings</p><h3>{{ $totalBookings }}</h3></div>
            <div class="stat-card"><p>Pending Holds</p><h3>{{ $heldBookings }}</h3></div>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Equipment</th>
                        <th>Dates</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentBookings as $booking)
                    <tr>
                        <td><strong>{{ $booking->customer_name }}</strong><br><small>{{ $booking->customer_email }}</small></td>
                        <td>{{ $booking->item->name }}</td>
                        <td>{{ $booking->start_date->format('M d') }} - {{ $booking->end_date->format('M d') }}</td>
                        <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
