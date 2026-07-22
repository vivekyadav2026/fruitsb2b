@extends('layouts.storefront')

@section('content')

<style>
.prof-wrap{ padding:34px 0 80px; }
.prof-head{
  display:flex; align-items:center; gap:20px; background:var(--surface); border:1px solid var(--line);
  border-radius:20px; padding:26px; box-shadow:var(--shadow-sm); margin:22px 0 30px;
}
.avatar{ width:64px;height:64px;border-radius:50%; background:var(--forest); color:#fff; display:flex;align-items:center;justify-content:center; font-size:22px; font-weight:700; }
.prof-head .info{ flex:1; }
.prof-head .info h2{ font-size:19px; margin-bottom: 2px;}
.prof-head .info .sub{ font-size:13px; color:var(--ink-soft); margin-top:2px; }
.tier-chip{ font-size:11.5px; font-weight:700; color:var(--gold); background:var(--gold-soft); padding:4px 10px; border-radius:20px; }

.prof-layout{ display:grid; grid-template-columns:1fr 1fr; gap:24px; }
@media (max-width:820px){ .prof-layout{ grid-template-columns:1fr; } }
.prof-card{ background:var(--surface); border:1px solid var(--line); border-radius:18px; padding:24px; box-shadow:var(--shadow-sm); }
.prof-card h3{ font-size:16px; font-family:'Fraunces',serif; margin-bottom:18px; margin-top:0;}
.two-col{ display:grid; grid-template-columns:1fr 1fr; gap:14px; }

.addr-row{ display:flex; justify-content:space-between; align-items:flex-start; padding:14px 0; border-bottom:1px solid var(--line); }
.addr-row:last-child{ border-bottom:none; }
.addr-row .a-name{ font-weight:600; font-size:14px; }
.addr-row .a-detail{ font-size:12.5px; color:var(--ink-soft); margin-top:2px; max-width:280px; }

.toggle-row{ display:flex; justify-content:space-between; align-items:center; padding:12px 0; border-bottom:1px solid var(--line); font-size:14px; }
.toggle-row:last-child{ border-bottom:none; }
.switch{ width:40px;height:22px;border-radius:20px; background:var(--forest); position:relative; }
.switch::after{ content:""; position:absolute; width:16px;height:16px;border-radius:50%; background:#fff; top:3px; right:3px; }
.switch.off{ background:var(--line-strong); }
.switch.off::after{ left:3px; right:auto; }

.err-msg { color: var(--danger); font-size: 12px; margin-top: 4px; }
.success-msg { background: var(--success); color: #fff; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 500; font-size: 14px; }
</style>

<div class="container prof-wrap">
  <span class="eyebrow">Account</span>
  <h1 class="serif" style="font-size:32px;font-weight:600; margin-top:4px;">My Profile</h1>

  @if (session('status') === 'profile-updated')
      <div class="success-msg">Profile updated successfully.</div>
  @endif
  @if (session('status') === 'password-updated')
      <div class="success-msg">Password updated successfully.</div>
  @endif

  <div class="prof-head">
    <div class="avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
    <div class="info">
      <h2>{{ $user->name }}</h2>
      <div class="sub">{{ $user->email }} · Registered {{ $user->created_at->format('M Y') }}</div>
    </div>
    @if($user->role === 'ADMIN')
        <span class="tier-chip">★ Admin</span>
    @else
        <span class="tier-chip">★ Priority Buyer</span>
    @endif
  </div>

  <div class="prof-layout">
    
    <!-- Profile Update Form -->
    <div class="prof-card">
      <h3>Business Details</h3>
      <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')
        
        <div class="two-col" style="margin-bottom:16px;">
          <div class="field">
              <label>Business Name</label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
              @if($errors->updateProfileInformation->has('name'))
                  <div class="err-msg">{{ $errors->updateProfileInformation->first('name') }}</div>
              @endif
          </div>
          <div class="field">
              <label>Email Address</label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
              @if($errors->updateProfileInformation->has('email'))
                  <div class="err-msg">{{ $errors->updateProfileInformation->first('email') }}</div>
              @endif
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
      </form>
    </div>

    <!-- Password Update Form -->
    <div class="prof-card">
      <h3>Update Password</h3>
      <form method="post" action="{{ route('password.update') }}">
          @csrf
          @method('put')
          
          <div class="field">
              <label>Current Password</label>
              <input type="password" name="current_password" autocomplete="current-password">
              @if($errors->updatePassword->has('current_password'))
                  <div class="err-msg">{{ $errors->updatePassword->first('current_password') }}</div>
              @endif
          </div>
          
          <div class="two-col" style="margin-bottom:16px;">
              <div class="field">
                  <label>New Password</label>
                  <input type="password" name="password" autocomplete="new-password">
                  @if($errors->updatePassword->has('password'))
                      <div class="err-msg">{{ $errors->updatePassword->first('password') }}</div>
                  @endif
              </div>
              <div class="field">
                  <label>Confirm Password</label>
                  <input type="password" name="password_confirmation" autocomplete="new-password">
                  @if($errors->updatePassword->has('password_confirmation'))
                      <div class="err-msg">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                  @endif
              </div>
          </div>
          
          <button type="submit" class="btn btn-outline btn-sm">Update Password</button>
      </form>
    </div>

    <div class="prof-card">
      <h3>Notifications</h3>
      <div class="toggle-row"><span>Daily price update alerts</span><div class="switch"></div></div>
      <div class="toggle-row"><span>Order status updates</span><div class="switch"></div></div>
      <div class="toggle-row"><span>WhatsApp notifications</span><div class="switch off"></div></div>
    </div>

    <div class="prof-card">
      <h3>Account Actions</h3>
      <div class="toggle-row">
          <span>Download order history</span>
          <a href="{{ route('orders.index') }}" class="btn btn-ghost btn-sm" style="text-decoration:none;">View All</a>
      </div>
      <div class="toggle-row">
          <span>Log out of this device</span>
          <form method="POST" action="{{ route('logout') }}" style="margin:0;">
              @csrf
              <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--danger); cursor:pointer;">Log Out</button>
          </form>
      </div>
    </div>
    
  </div>
</div>

@endsection
