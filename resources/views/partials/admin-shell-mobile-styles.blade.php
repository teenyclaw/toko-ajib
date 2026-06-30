@once
<style>
.sb-toggle-btn{
  display:none;align-items:center;justify-content:center;
  width:34px;height:34px;flex-shrink:0;padding:0;
  background:var(--bg3,#18181c);border:1px solid var(--bd2,rgba(255,255,255,.09));
  color:var(--tx2,#938f88);border-radius:8px;cursor:pointer;transition:all .14s;
}
.sb-toggle-btn:hover{border-color:var(--go,#c9a44e);color:var(--go,#c9a44e);background:var(--gd,rgba(201,164,78,.09))}
.sb-toggle-btn svg{width:16px;height:16px}
.admin-sb-backdrop{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:190;backdrop-filter:blur(2px)}
.admin-sb-backdrop.show{display:block}
.sb .sb-close{
  display:none;position:absolute;top:16px;right:10px;
  width:30px;height:30px;align-items:center;justify-content:center;
  background:var(--bg3,#18181c);border:1px solid var(--bd2,rgba(255,255,255,.09));
  color:var(--tx2,#938f88);border-radius:7px;cursor:pointer;padding:0;
}
.sb .sb-close:hover{color:var(--rd,#f87171);border-color:rgba(248,113,113,.25)}
.sb .sb-close svg{width:14px;height:14px}
.sb-logo{position:relative}
@media(max-width:900px){
  .sb-toggle-btn{display:inline-flex}
  .app.admin-shell{grid-template-columns:1fr!important}
  .app.admin-shell .sb{
    position:fixed;left:0;top:0;width:min(280px,88vw);
    height:100vh;height:100dvh;z-index:200;
    transform:translateX(-100%);transition:transform .22s ease;
    box-shadow:0 8px 40px rgba(0,0,0,.6);overflow:hidden;
  }
  .app.admin-shell.admin-sb-open .sb{transform:translateX(0)}
  .app.admin-shell .sb .sb-close{display:inline-flex}
}
</style>
@endonce
