<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password SIMDA Barang</title>
</head>
<body style="margin:0; padding:0; background:#f1f5f9; font-family:Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 0">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="background:#2563eb; padding:20px; text-align:center;">
                            <img src="{{ asset('admin_simda/logo/logo_white.png') }}"
                                alt="SIMDA Barang"
                                width="60"
                                style="margin-bottom:10px;">
                            <h2 style="color:#ffffff; margin:0;">SIMDA Barang</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px; color:#1f2937; font-size:14px; line-height:1.6;">
                            <p>Halo,</p>
                            <p>
                                Kami menerima permintaan untuk mengatur ulang (reset) password akun Anda
                                pada sistem <strong>SIMDA Barang</strong>.
                            </p>
                            <p>
                                Silakan klik tombol di bawah ini untuk membuat password baru:
                            </p>
                            <p style="text-align:center; margin:30px 0;">
                                <a href="{{ $actionUrl }}"
                                style="background:#2563eb; color:#ffffff; text-decoration:none;
                                        padding:12px 24px; border-radius:6px; display:inline-block;">
                                    Reset Password
                                </a>
                            </p>
                            <p>
                                Link reset password ini hanya berlaku selama
                                <strong>{{ $expireMinutes }} menit</strong>.
                            </p>
                            <p style="color:#6b7280; font-size:13px;">
                                Jika Anda tidak merasa meminta reset password,
                                silakan abaikan email ini. Tidak ada perubahan yang akan dilakukan
                                pada akun Anda.
                            </p>
                            <p>
                                Terima kasih,<br>
                                <strong>Tim SIMDA Barang</strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f8fafc; padding:15px; text-align:center; font-size:12px; color:#6b7280;">
                            © {{ date('Y') }} Pemerintah Kota Samarinda<br>
                            Email ini dikirim secara otomatis, mohon tidak membalas email ini.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
