<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log In — Mandi Prime</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#F5F7F3; --surface:#FFFFFF; --ink:#10241C; --ink-soft:#54685C; --ink-faint:#8C9A91;
  --forest:#0F3326; --forest-2:#164A37; --gold:#AD8A3C; --gold-soft:#F1E7CE;
  --line:rgba(16,36,28,0.09); --line-strong:rgba(16,36,28,0.16);
  --danger:#AE3B34; --success:#2E7A4D; --radius:16px;
}
*{ box-sizing:border-box; }
html,body{ margin:0; padding:0; background:var(--bg); color:var(--ink); font-family:'Inter', sans-serif; -webkit-font-smoothing:antialiased; font-feature-settings:"tnum" 1, "cv11" 1; }
a{ color:inherit; text-decoration:none; }
.btn-primary{ background:var(--forest); color:#fff; border:none; padding:12px 24px; border-radius:999px; font-weight:600; cursor:pointer; display:inline-block; text-align:center; }
.btn-primary:hover{ background:var(--forest-2); }
.btn-block{ width:100%; }

.auth-shell{ min-height:100vh; display:grid; grid-template-columns:1fr 1fr; }
@media (max-width:880px){ .auth-shell{ grid-template-columns:1fr; } .auth-visual{ display:none; } }

.auth-visual{ background:radial-gradient(circle at 30% 20%, #1B4B37, #0F3326 60%); color:#fff; padding:60px 50px; display:flex; flex-direction:column; justify-content:space-between; position:relative; overflow:hidden; }
.auth-visual::after{ content:""; position:absolute; right:-60px; bottom:-60px; width:260px; height:260px; border-radius:50%; background:rgba(173,138,60,0.15); }
.auth-visual .top .word{ font-size:20px; font-weight:600; }
.auth-visual .top .word em{ color:var(--gold); font-family:'Fraunces',serif; font-style:normal; }
.auth-visual h2{ font-size:34px; font-family:'Fraunces',serif; font-weight:600; line-height:1.2; margin:30px 0 16px; max-width:380px; }
.auth-visual p{ color:rgba(255,255,255,0.75); max-width:360px; line-height:1.6; font-size:14.5px; }

.auth-form{ display:flex; align-items:center; justify-content:center; padding:40px; }
.auth-card{ width:100%; max-width:360px; }
.auth-tabs{ display:flex; gap:4px; background:var(--surface); border:1px solid var(--line-strong); border-radius:12px; padding:4px; margin-bottom:28px; }
.auth-tabs a{ flex:1; text-align:center; padding:10px; border-radius:9px; font-size:13.5px; font-weight:600; color:var(--ink-soft); }
.auth-tabs a.active{ background:var(--forest); color:#fff; }
.auth-card h1{ font-size:26px; font-family:'Fraunces',serif; font-weight:600; margin-bottom:6px; }
.auth-card .sub{ font-size:13.5px; color:var(--ink-soft); margin-bottom:26px; }

.field{ margin-bottom:16px; }
.field label{ display:block; font-size:13px; font-weight:600; margin-bottom:6px; color:var(--ink-soft); }
.field input{ width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--line-strong); background:var(--surface); font-size:14.5px; color:var(--ink); font-family:inherit; }
.field input:focus{ outline:none; border-color:var(--gold); box-shadow:0 0 0 3px rgba(173,138,60,0.15); }
.error-msg{ color:var(--danger); font-size:12px; margin-top:4px; display:block; }
</style></head><body>
<div class="auth-shell">
  <div class="auth-visual">
    <div class="top">
      <div class="word">Mandi <em>Prime</em></div>
    </div>
    <div>
      <h2>Your regular buyers,<br>ordering on their own time.</h2>
      <p>Log in to see today's rates, reorder your usuals, and track every order from the yard to your counter.</p>
    </div>
  </div>

  <div class="auth-form">
    <div class="auth-card">
      <div class="auth-tabs">
        <a href="{{ route('login') }}" class="active">Log In</a>
        <a href="{{ route('register') }}">Register</a>
      </div>
      <h1>Welcome back</h1>
      <div class="sub">Enter your email and password to continue.</div>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
          <label>Email Address</label>
          <input type="email" name="email" value="{{ old('email') }}" required autofocus>
          @error('email')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        
        <div class="field">
          <label>Password</label>
          <input type="password" name="password" required>
          @error('password')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        <button type="submit" class="btn-primary btn-block" style="margin-top:10px;">Log In</button>
      </form>
    </div>
  </div>
</div>
</body></html>
