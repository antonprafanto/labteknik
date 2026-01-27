<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
        .status-badge { display: inline-block; padding: 8px 16px; border-radius: 20px; font-weight: bold; margin: 10px 0; }
        .status-approved { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }
        .info-row { margin: 10px 0; }
        .label { font-weight: bold; color: #6b7280; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">Peminjaman Ruangan - Update Status</h1>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $roomBorrowing->borrower_name }}</strong>,</p>
            
            <p>Peminjaman ruangan Anda telah diupdate.</p>
            
            <div class="info-row">
                <span class="label">Nomor Booking:</span> {{ $roomBorrowing->booking_number }}
            </div>
            
            <div class="info-row">
                <span class="label">Ruangan:</span> {{ $roomBorrowing->room->name }} ({{ $roomBorrowing->room->code }})
            </div>
            
            <div class="info-row">
                <span class="label">Waktu Peminjaman:</span><br>
                {{ $roomBorrowing->start_datetime->format('d F Y, H:i') }} - {{ $roomBorrowing->end_datetime->format('d F Y, H:i') }}
            </div>
            
            <div class="info-row">
                <span class="label">Status:</span><br>
                @if($roomBorrowing->status === 'approved')
                    <span class="status-badge status-approved">✓ DISETUJUI</span>
                @elseif($roomBorrowing->status === 'rejected')
                    <span class="status-badge status-rejected">✗ DITOLAK</span>
                @endif
            </div>
            
            @if($roomBorrowing->status === 'approved')
                <p style="background: #dbeafe; padding: 15px; border-left: 4px solid #3b82f6; border-radius: 4px;">
                    <strong>Selamat!</strong> Peminjaman ruangan Anda telah disetujui. Silakan datang sesuai jadwal yang telah ditentukan.
                </p>
            @endif
            
            @if($roomBorrowing->status === 'rejected' && $roomBorrowing->rejection_reason)
                <div style="background: #fee2e2; padding: 15px; border-left: 4px solid #ef4444; border-radius: 4px; margin-top: 15px;">
                    <strong>Alasan Penolakan:</strong><br>
                    {{ $roomBorrowing->rejection_reason }}
                </div>
            @endif
            
            <p style="margin-top: 20px;">
                <a href="{{ route('room-borrowings.index') }}" style="display: inline-block; background: #667eea; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold;">
                    Lihat Detail Peminjaman
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh Sistem Informasi Laboratorium.</p>
            <p>&copy; {{ date('Y') }} Lab Teknik. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
