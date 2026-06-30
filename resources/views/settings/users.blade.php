<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Manajemen Pengguna — POS AJIB</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bd:rgba(255,255,255,.06);--bd2:rgba(255,255,255,.1);--tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;--go:#c9a44e;--go2:#e4bf6a;--gd:rgba(201,164,78,.12);--gn:#3ecf8e;--gnd:rgba(62,207,142,.12);--rd:#f87171;--rdd:rgba(248,113,113,.12);--bl:#60a5fa;--bld:rgba(96,165,250,.12);--rr:12px;--rs:8px;--rx:6px;--fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace}
html,body{min-height:100%}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5}
.app{display:grid;grid-template-columns:216px 1fr;min-height:100vh}
.sb{background:var(--bg2);border-right:1px solid var(--bd);display:flex;flex-direction:column}
.sb-logo{padding:20px 16px 18px;border-bottom:1px solid var(--bd)}
.logo{display:flex;align-items:center;gap:10px}
.logo-ico{width:30px;height:30px;background:var(--go);border-radius:7px;display:flex;align-items:center;justify-content:center}
.logo-ico svg{width:16px;height:16px;color:#09090b}
.logo-name{font-size:14px;font-weight:600}
.logo-tag{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.9px}
.nav{padding:8px 6px;flex:1}
.nav-sec{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:1px;padding:14px 10px 5px}
.nav-a{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:var(--rs);color:var(--tx2);text-decoration:none;font-size:13px;margin-bottom:1px}
.nav-a:hover{background:var(--bg3);color:var(--tx)}
.nav-a.on{background:var(--gd);color:var(--go)}
.ni{width:14px;height:14px;opacity:.6}
.nav-a.on .ni{opacity:1}
.sb-foot{padding:12px 14px;border-top:1px solid var(--bd)}
.u-row{display:flex;align-items:center;gap:8px}
.uav{width:26px;height:26px;border-radius:50%;background:var(--gd);border:1px solid rgba(201,164,78,.17);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--go)}
.u-nm{font-size:12.5px;font-weight:500}
.u-rl{font-size:10.5px;color:var(--tx3)}
.main{display:flex;flex-direction:column;min-height:100vh}
.topbar{height:52px;padding:0 22px;border-bottom:1px solid var(--bd);background:var(--bg2);display:flex;align-items:center;gap:10px;flex-shrink:0}
.tb-ttl{font-size:14.5px;font-weight:500;flex:1}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:8px 14px;border-radius:var(--rs);border:none;cursor:pointer;font-family:var(--fn);font-size:13px;font-weight:600;text-decoration:none;transition:all .14s}
.btn-primary{background:var(--go);color:#09090b}
.btn-primary:hover{background:var(--go2)}
.btn-ghost{background:var(--bg3);color:var(--tx2);border:1px solid var(--bd2)}
.btn-ghost:hover{border-color:var(--go);color:var(--go)}
.btn-sm{padding:6px 10px;font-size:12px}
.btn-rd{background:var(--rdd);color:var(--rd);border:1px solid rgba(248,113,113,.2)}
.btn-rd:hover{background:rgba(248,113,113,.18)}
.wrap{padding:20px 22px 40px;flex:1}
.alert{padding:12px 14px;border-radius:var(--rs);margin-bottom:16px;font-size:13px}
.alert-ok{background:var(--gnd);color:var(--gn);border:1px solid rgba(62,207,142,.25)}
.alert-err{background:var(--rdd);color:var(--rd);border:1px solid rgba(248,113,113,.25)}
.grid{display:grid;grid-template-columns:340px 1fr;gap:16px;align-items:start}
@media(max-width:960px){.grid{grid-template-columns:1fr}}
.card{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:18px}
.card-ttl{font-size:13px;font-weight:600;margin-bottom:4px}
.card-sub{font-size:12px;color:var(--tx2);margin-bottom:14px}
.field{margin-bottom:12px}
.field label{display:block;font-size:12px;color:var(--tx2);margin-bottom:5px}
.field input,.field select{width:100%;padding:10px 12px;border-radius:var(--rs);background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);font-family:var(--fn);font-size:13px}
.field input:focus,.field select:focus{outline:none;border-color:var(--go)}
.field-err{font-size:11px;color:var(--rd);margin-top:4px}
table{width:100%;border-collapse:collapse}
thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;padding:9px 12px;text-align:left;border-bottom:1px solid var(--bd);background:var(--bg3)}
tbody tr{border-bottom:1px solid var(--bd)}
tbody tr:hover{background:rgba(255,255,255,.015)}
tbody td{padding:12px;font-size:13px;color:var(--tx2);vertical-align:middle}
.c-nm{font-weight:500;color:var(--tx)}
.c-email{font-family:var(--mo);font-size:12px;color:var(--tx3)}
.badge{display:inline-flex;padding:2px 8px;border-radius:20px;font-size:10.5px;font-weight:600}
.badge-admin{background:var(--bld);color:var(--bl)}
.badge-kasir{background:var(--gd);color:var(--go)}
.badge-me{background:var(--gnd);color:var(--gn);margin-left:6px;font-size:10px}
.actions{display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end}
.inline-form{display:flex;gap:6px;align-items:center;flex-wrap:wrap}
.inline-form select,.inline-form input{min-width:100px;padding:6px 8px;border-radius:var(--rx);background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);font-size:12px}
.hint{font-size:11px;color:var(--tx3);margin-top:10px;line-height:1.5}
.ov{position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:40;opacity:0;pointer-events:none;transition:opacity .2s}
.ov.on{opacity:1;pointer-events:all}
.panel{position:fixed;top:0;right:0;bottom:0;width:380px;background:var(--bg2);border-left:1px solid var(--bd2);z-index:41;transform:translateX(100%);transition:transform .25s;display:flex;flex-direction:column}
.panel.on{transform:translateX(0)}
.p-head{padding:16px 18px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:10px}
.p-ttl{font-size:14px;font-weight:600;flex:1}
.p-cls{width:28px;height:28px;border-radius:var(--rx);background:var(--bg4);border:1px solid var(--bd2);color:var(--tx2);cursor:pointer}
.p-body{flex:1;overflow-y:auto;padding:18px}
.p-foot{padding:14px 18px;border-top:1px solid var(--bd)}
</style>
@include('partials.admin-shell-mobile-styles')
</head>
<body>
@include('partials.admin-shell-mobile-body-start')
@include('partials.sidebar', ['active' => 'settings-users', 'sidebarId' => 'sb'])

<main class="main">
<div class="topbar">
  @include('partials.sb-toggle')
  <div class="tb-ttl">Manajemen Pengguna</div>
  <button type="button" class="btn btn-primary" onclick="openAdd()">+ Tambah Akun</button>
</div>

<div class="wrap">
  @if(session('success'))
    <div class="alert alert-ok">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-err">{{ session('error') }}</div>
  @endif

  <div class="grid">
    <div class="card">
      <div class="card-ttl">Tambah Akun Baru</div>
      <div class="card-sub">Buat akun kasir atau admin. Pendaftaran publik dinonaktifkan.</div>
      <form method="POST" action="{{ route('settings.users.store') }}">
        @csrf
        <div class="field">
          <label for="add-name">Nama</label>
          <input type="text" id="add-name" name="name" value="{{ old('name') }}" required maxlength="255">
          @error('name')<div class="field-err">{{ $message }}</div>@enderror
        </div>
        <div class="field">
          <label for="add-email">Email</label>
          <input type="email" id="add-email" name="email" value="{{ old('email') }}" required maxlength="255">
          @error('email')<div class="field-err">{{ $message }}</div>@enderror
        </div>
        <div class="field">
          <label for="add-role">Role</label>
          <select id="add-role" name="role" required>
            <option value="kasir" {{ old('role', 'kasir') === 'kasir' ? 'selected' : '' }}>Kasir</option>
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role')<div class="field-err">{{ $message }}</div>@enderror
        </div>
        <div class="field">
          <label for="add-password">Password</label>
          <input type="password" id="add-password" name="password" required autocomplete="new-password" minlength="8">
          @error('password')<div class="field-err">{{ $message }}</div>@enderror
        </div>
        <div class="field">
          <label for="add-password_confirmation">Konfirmasi Password</label>
          <input type="password" id="add-password_confirmation" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%">Simpan Akun</button>
      </form>
      <p class="hint">Kasir hanya melihat menu Kasir &amp; Pesanan Online. Password minimal 8 karakter.</p>
    </div>

    <div class="card" style="padding:0;overflow:hidden">
      <div style="padding:16px 18px 12px;border-bottom:1px solid var(--bd)">
        <div class="card-ttl" style="margin:0">Daftar Pengguna</div>
        <div class="card-sub" style="margin:4px 0 0">{{ $users->count() }} akun terdaftar</div>
      </div>
      <div style="overflow-x:auto">
        <table>
          <thead>
            <tr>
              <th>Pengguna</th>
              <th>Role</th>
              <th style="text-align:right">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>
                <div class="c-nm">
                  {{ $user->name }}
                  @if($user->id === auth()->id())<span class="badge badge-me">Anda</span>@endif
                </div>
                <div class="c-email">{{ $user->email }}</div>
              </td>
              <td>
                <form method="POST" action="{{ route('settings.users.update', $user) }}" class="inline-form">
                  @csrf
                  <input type="hidden" name="name" value="{{ $user->name }}">
                  <input type="hidden" name="email" value="{{ $user->email }}">
                  <select name="role" onchange="this.form.submit()" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    <option value="kasir" {{ $user->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                  </select>
                </form>
              </td>
              <td>
                <div class="actions">
                  <button type="button" class="btn btn-ghost btn-sm btn-edit-user"
                    data-id="{{ $user->id }}"
                    data-name="{{ $user->name }}"
                    data-email="{{ $user->email }}"
                    data-role="{{ $user->role }}">Edit</button>
                  <button type="button" class="btn btn-ghost btn-sm btn-pwd-user"
                    data-id="{{ $user->id }}"
                    data-name="{{ $user->name }}">Password</button>
                  @if($user->id !== auth()->id())
                  <form method="POST" action="{{ route('settings.users.destroy', $user) }}" class="form-delete-user" data-confirm="Hapus akun {{ $user->name }}?">
                    @csrf
                    <button type="submit" class="btn btn-rd btn-sm">Hapus</button>
                  </form>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</main>
</div>

<div class="ov" id="ov" onclick="closePanels()"></div>

<div class="panel" id="panel-edit">
  <div class="p-head">
    <div class="p-ttl">Edit Pengguna</div>
    <button type="button" class="p-cls" onclick="closePanels()">×</button>
  </div>
  <form method="POST" id="form-edit" action="">
    @csrf
    <input type="hidden" name="_panel" value="edit">
    <input type="hidden" name="_user_id" id="edit-user-id" value="">
    <div class="p-body">
      <div class="field">
        <label>Nama</label>
        <input type="text" name="name" id="edit-name" value="{{ old('name') }}" required maxlength="255">
        @error('name')<div class="field-err">{{ $message }}</div>@enderror
      </div>
      <div class="field">
        <label>Email</label>
        <input type="email" name="email" id="edit-email" value="{{ old('email') }}" required maxlength="255">
        @error('email')<div class="field-err">{{ $message }}</div>@enderror
      </div>
      <div class="field">
        <label>Role</label>
        <select name="role" id="edit-role">
          <option value="kasir" {{ old('role') === 'kasir' ? 'selected' : '' }}>Kasir</option>
          <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')<div class="field-err">{{ $message }}</div>@enderror
      </div>
    </div>
    <div class="p-foot">
      <button type="submit" class="btn btn-primary" style="width:100%">Simpan Perubahan</button>
    </div>
  </form>
</div>

<div class="panel" id="panel-pwd">
  <div class="p-head">
    <div class="p-ttl" id="pwd-ttl">Reset Password</div>
    <button type="button" class="p-cls" onclick="closePanels()">×</button>
  </div>
  <form method="POST" id="form-pwd" action="">
    @csrf
    <input type="hidden" name="_panel" value="password">
    <input type="hidden" name="_user_id" id="pwd-user-id" value="">
    <div class="p-body">
      <div class="field">
        <label>Password Baru</label>
        <input type="password" name="password" required autocomplete="new-password" minlength="8">
        @error('password')<div class="field-err">{{ $message }}</div>@enderror
      </div>
      <div class="field">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required autocomplete="new-password" minlength="8">
      </div>
      <p class="hint">Minimal 8 karakter.</p>
    </div>
    <div class="p-foot">
      <button type="submit" class="btn btn-primary" style="width:100%">Ubah Password</button>
    </div>
  </form>
</div>

@php
  $reopenPanel = old('_panel', session('_panel'));
  $reopenUserId = old('_user_id', session('_user_id'));
  $reopenPwdName = $reopenUserId ? ($users->firstWhere('id', (int) $reopenUserId)?->name ?? 'User') : '';
@endphp

<script>
const ROUTES = {
  update: @json(route('settings.users.update', ['user' => 0])).replace('/0/update', ''),
  password: @json(route('settings.users.password', ['user' => 0])).replace('/0/password', ''),
};

function openAdd() {
  document.getElementById('add-name')?.focus();
  document.getElementById('add-name')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function openEdit(id, name, email, role) {
  document.getElementById('form-edit').action = ROUTES.update + '/' + id + '/update';
  document.getElementById('edit-user-id').value = id;
  document.getElementById('edit-name').value = name ?? '';
  document.getElementById('edit-email').value = email ?? '';
  document.getElementById('edit-role').value = role ?? 'kasir';
  document.getElementById('ov').classList.add('on');
  document.getElementById('panel-edit').classList.add('on');
  document.getElementById('panel-pwd').classList.remove('on');
}

function openPwd(id, name) {
  document.getElementById('form-pwd').action = ROUTES.password + '/' + id + '/password';
  document.getElementById('pwd-user-id').value = id;
  document.getElementById('pwd-ttl').textContent = 'Password — ' + (name ?? '');
  document.getElementById('ov').classList.add('on');
  document.getElementById('panel-pwd').classList.add('on');
  document.getElementById('panel-edit').classList.remove('on');
}

function closePanels() {
  document.getElementById('ov').classList.remove('on');
  document.getElementById('panel-edit').classList.remove('on');
  document.getElementById('panel-pwd').classList.remove('on');
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.btn-edit-user').forEach(function (btn) {
    btn.addEventListener('click', function () {
      openEdit(btn.dataset.id, btn.dataset.name, btn.dataset.email, btn.dataset.role);
    });
  });

  document.querySelectorAll('.btn-pwd-user').forEach(function (btn) {
    btn.addEventListener('click', function () {
      openPwd(btn.dataset.id, btn.dataset.name);
    });
  });

  document.querySelectorAll('.form-delete-user').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      if (!confirm(form.dataset.confirm || 'Hapus akun ini?')) {
        e.preventDefault();
      }
    });
  });

  @if($reopenPanel === 'edit' && $reopenUserId)
  openEdit(
    {{ (int) $reopenUserId }},
    @json(old('name')),
    @json(old('email')),
    @json(old('role', 'kasir'))
  );
  @elseif($reopenPanel === 'password' && $reopenUserId)
  openPwd({{ (int) $reopenUserId }}, @json($reopenPwdName));
  @endif
});
</script>
@include('partials.admin-shell-mobile-scripts')
</body>
</html>
