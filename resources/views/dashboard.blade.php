<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Kasir — POS AJIB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bg5:#2a2a30;
  --bd:rgba(255,255,255,.055);--bd2:rgba(255,255,255,.09);--bd3:rgba(255,255,255,.15);
  --tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;
  --go:#c9a44e;--go2:#e4bf6a;
  --gd:rgba(201,164,78,.09);--gd2:rgba(201,164,78,.17);--gd3:rgba(201,164,78,.27);
  --gn:#3ecf8e;--gnd:rgba(62,207,142,.09);
  --rd:#f87171;--rdd:rgba(248,113,113,.09);
  --pu:#a78bfa;--pud:rgba(167,139,250,.10);
  --rr:12px;--rs:8px;--rx:6px;
  --fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;
  --shl:0 8px 40px rgba(0,0,0,.6);
  --cart-w:320px;--cart-tab-w:44px;--main-min:280px
}
html,body{height:100%;overflow:hidden}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
/* Grid 2 kolom: produk | keranjang — sidebar overlay (tidak makan lebar grid) */
.app{
  display:grid;
  grid-template-columns:minmax(var(--main-min),1fr) var(--cart-w);
  grid-template-areas:"main cart";
  height:100vh;
  overflow:hidden;
  transition:grid-template-columns .22s ease;
}
.app.cart-collapsed{--cart-w:var(--cart-tab-w)}

/* SIDEBAR — fixed overlay, tidak ikut grid */
.sb{
  position:fixed;left:0;top:0;width:216px;height:100vh;z-index:100;
  background:var(--bg2);border-right:1px solid var(--bd);
  display:flex;flex-direction:column;overflow:hidden;
  transform:translateX(-100%);transition:transform .22s ease;
  box-shadow:var(--shl);
}
.app.sb-open .sb{transform:translateX(0)}
.sb-logo{padding:20px 16px 18px;border-bottom:1px solid var(--bd)}
.logo{display:flex;align-items:center;gap:10px}
.logo-ico{width:30px;height:30px;background:var(--go);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.logo-ico svg{width:16px;height:16px;color:#09090b}
.logo-name{font-size:14px;font-weight:600;letter-spacing:-.2px}
.logo-tag{font-size:9.5px;color:var(--tx3);letter-spacing:.9px;text-transform:uppercase}
.nav{padding:8px 6px;flex:1}
.nav-sec{font-size:9.5px;color:var(--tx3);letter-spacing:1px;text-transform:uppercase;padding:14px 10px 5px;font-weight:500}
.nav-a{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:var(--rs);color:var(--tx2);text-decoration:none;font-size:13px;transition:all .14s;margin-bottom:1px}
.nav-a:hover{background:var(--bg3);color:var(--tx)}
.nav-a.on{background:var(--gd);color:var(--go)}
.ni{width:14px;height:14px;flex-shrink:0;opacity:.6}
.nav-a.on .ni{opacity:1}
.sb-foot{padding:12px 14px;border-top:1px solid var(--bd)}
.u-row{display:flex;align-items:center;gap:8px;padding:6px 8px;border-radius:var(--rs)}
.uav{width:26px;height:26px;border-radius:50%;background:var(--gd);border:1px solid var(--gd2);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--go);flex-shrink:0}
.u-nm{font-size:12.5px;font-weight:500}
.u-rl{font-size:10.5px;color:var(--tx3)}

/* LAYOUT TOGGLES */
.layout-btn{display:flex;align-items:center;justify-content:center;width:34px;height:34px;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rs);cursor:pointer;transition:all .14s;flex-shrink:0;padding:0}
.layout-btn:hover{border-color:var(--go);color:var(--go);background:var(--gd)}
.layout-btn svg{width:16px;height:16px}
.sb-backdrop{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:90;backdrop-filter:blur(2px)}
.sb-backdrop.show{display:block}

/* MAIN */
.main{grid-area:main;display:flex;flex-direction:column;overflow:hidden;background:var(--bg);min-width:0}
.topbar{padding:0 22px;height:52px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:12px;flex-shrink:0;background:var(--bg2)}
.topbar-ttl{font-size:14.5px;font-weight:500;flex:1}
.clock{font-family:var(--mo);font-size:12px;color:var(--tx3);background:var(--bg3);padding:4px 10px;border-radius:6px;border:1px solid var(--bd)}

/* PRICE MODE INDICATOR */
.price-mode{display:flex;align-items:center;gap:6px;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500;transition:all .3s}
.pm-member{background:var(--gd);color:var(--go);border:1px solid var(--gd2)}
.pm-nonmember{background:var(--pud);color:var(--pu);border:1px solid rgba(167,139,250,.25)}
.pm-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.pm-member .pm-dot{background:var(--go)}
.pm-nonmember .pm-dot{background:var(--pu)}

/* SEARCH */
.search-area{padding:14px 22px;border-bottom:1px solid var(--bd);flex-shrink:0}
/* Select2 override */
.select2-container--default .select2-selection--single{background:var(--bg3)!important;border:1px solid var(--bd2)!important;border-radius:var(--rs)!important;height:40px!important;display:flex!important;align-items:center!important;padding-left:12px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered{color:var(--tx)!important;font-family:var(--fn)!important;font-size:13px!important;line-height:40px!important;padding-left:0!important}
.select2-container--default .select2-selection--single .select2-selection__placeholder{color:var(--tx3)!important}
.select2-container--default .select2-selection--single .select2-selection__arrow{height:40px!important}
.select2-dropdown{background:var(--bg3)!important;border:1px solid var(--bd2)!important;border-radius:var(--rs)!important;box-shadow:0 8px 32px rgba(0,0,0,.5)!important}
.select2-container--default .select2-results__option{color:var(--tx2)!important;font-family:var(--fn)!important;font-size:13px!important;padding:8px 12px!important}
.select2-container--default .select2-results__option--highlighted{background:var(--bg4)!important;color:var(--tx)!important}
.select2-container--default .select2-search--dropdown .select2-search__field{background:var(--bg4)!important;border:1px solid var(--bd2)!important;color:var(--tx)!important;font-family:var(--fn)!important;border-radius:6px!important;padding:7px 10px!important}
.price-type-row{display:flex;gap:8px;margin-top:10px}
.price-btn{flex:1;padding:7px;border:1px solid var(--bd2);background:var(--bg3);color:var(--tx2);border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:12px;font-weight:500;transition:all .14s}
.price-btn.on{background:var(--gd);border-color:var(--go);color:var(--go)}
.price-btn:hover:not(.on){background:var(--bg4);color:var(--tx)}
.add-btn{width:100%;margin-top:10px;padding:9px;background:var(--go);color:#09090b;border:none;border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:13px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .14s}
.add-btn:hover{background:var(--go2)}
.add-btn:active{transform:scale(.98)}
.add-btn svg{width:14px;height:14px}

/* PRODUCT GRID */
.product-area{flex:1;overflow-y:auto;padding:14px 22px}
.product-area::-webkit-scrollbar{width:4px}
.product-area::-webkit-scrollbar-thumb{background:var(--bg4);border-radius:2px}
.sec-label{font-size:10px;color:var(--tx3);letter-spacing:.8px;text-transform:uppercase;font-weight:500;margin-bottom:10px}
.product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:8px}
.p-card{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:12px 10px;cursor:pointer;transition:all .14s;position:relative;overflow:hidden}
.p-card:hover{border-color:var(--bd2);transform:translateY(-1px)}
.p-card:active{transform:scale(.97)}
.p-card-cat{font-size:9.5px;color:var(--tx3);margin-bottom:5px;text-transform:uppercase;letter-spacing:.4px}
.p-card-name{font-size:12.5px;font-weight:500;color:var(--tx);line-height:1.3;margin-bottom:7px}
/* Harga member */
.p-card-price{font-size:11.5px;font-family:var(--mo);color:var(--go)}
/* Harga non-member */
.p-card-price-nm{font-size:11.5px;font-family:var(--mo);color:var(--pu);display:none}
.nm-mode .p-card-price{display:none}
.nm-mode .p-card-price-nm{display:block}
.p-card-stock{position:absolute;top:8px;right:8px;font-size:9.5px;background:var(--bg4);color:var(--tx3);padding:1px 5px;border-radius:3px;font-family:var(--mo)}
.p-card-stock.low{color:var(--rd)}

/* CART PANEL */
.cart-panel{
  grid-area:cart;
  background:var(--bg2);border-left:1px solid var(--bd);
  display:flex;flex-direction:column;overflow:hidden;
  min-width:0;width:100%;max-width:var(--cart-w);
  position:relative;
}
.cart-inner{display:flex;flex-direction:column;flex:1;min-height:0;overflow:hidden}
.app.cart-collapsed .cart-inner{display:none}
.cart-tab{display:none;flex-direction:column;align-items:center;padding:14px 6px;gap:10px;height:100%;cursor:pointer;color:var(--tx2);background:var(--bg2);border:none;width:100%;font-family:var(--fn);transition:background .14s}
.app.cart-collapsed .cart-tab{display:flex}
.cart-tab:hover{background:var(--bg3);color:var(--go)}
.cart-tab svg{width:20px;height:20px;flex-shrink:0}
.cart-tab-lbl{font-size:9px;letter-spacing:.5px;text-transform:uppercase;color:var(--tx3);writing-mode:vertical-rl;transform:rotate(180deg)}
.cart-tab-badge{font-size:10px;font-family:var(--mo);background:var(--gd);color:var(--go);border:1px solid var(--gd2);border-radius:10px;padding:2px 6px;min-width:20px;text-align:center}
.cart-header{padding:16px 18px 14px;border-bottom:1px solid var(--bd);display:flex;align-items:center;justify-content:space-between;flex-shrink:0;gap:8px}
.cart-header-actions{display:flex;align-items:center;gap:6px}
.cart-header-left{display:flex;align-items:center;gap:8px}
.cart-ttl{font-size:14px;font-weight:500}
.cart-count{background:var(--gd);color:var(--go);font-size:11px;font-family:var(--mo);font-weight:500;padding:2px 8px;border-radius:20px;border:1px solid var(--gd2)}
.cart-reset{display:flex;align-items:center;gap:5px;padding:5px 10px;background:transparent;border:1px solid var(--bd2);color:var(--tx3);border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:11.5px;font-weight:500;transition:all .14s;white-space:nowrap}
.cart-reset:hover:not(:disabled){background:var(--rdd);border-color:rgba(248,113,113,.3);color:var(--rd)}
.cart-reset:disabled{opacity:.35;cursor:not-allowed}
.cart-reset svg{width:12px;height:12px;flex-shrink:0}

/* CUSTOMER SECTION */
.cust-section{padding:12px 18px;border-bottom:1px solid var(--bd);flex-shrink:0}
.sec-ttl{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;margin-bottom:6px}
.cust-select{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:8px 11px;font-family:var(--fn);font-size:13px;appearance:none;cursor:pointer;outline:none;transition:border .14s}
.cust-select:focus{border-color:var(--go)}
.cust-select option{background:var(--bg3)}

/* DEBT WARNING */
.debt-warn{margin:0 18px 0;padding:9px 12px;background:var(--rdd);border:1px solid rgba(248,113,113,.2);border-radius:var(--rs);font-size:11.5px;color:var(--rd);display:none;align-items:flex-start;gap:7px;line-height:1.4}
.debt-warn.show{display:flex}
.debt-warn svg{width:13px;height:13px;flex-shrink:0;margin-top:1px}

.manual-section{padding:0 18px 10px;border-bottom:1px solid var(--bd);flex-shrink:0}
.manual-btn{width:100%;padding:8px 12px;background:var(--bg3);border:1px dashed var(--bd2);color:var(--tx2);border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:12.5px;font-weight:500;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .14s}
.manual-btn:hover{border-color:var(--pu);color:var(--pu);background:rgba(167,139,250,.08)}
.manual-btn svg{width:13px;height:13px}
.cart-items{flex:1;overflow-y:auto;padding:6px 0}
.cart-items::-webkit-scrollbar{width:3px}
.cart-items::-webkit-scrollbar-thumb{background:var(--bg4)}
.cart-empty{display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;gap:8px;color:var(--tx3)}
.cart-empty svg{width:36px;height:36px;opacity:.2}
.cart-empty p{font-size:12.5px}
.cart-item{padding:10px 18px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:8px;cursor:pointer;transition:background .1s}
.cart-item:hover{background:var(--bg3)}
.ci-info{flex:1;min-width:0}
.ci-name{font-size:13px;font-weight:500;color:var(--tx);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.ci-badge{display:inline-block;font-size:9px;color:var(--pu);background:rgba(167,139,250,.12);border:1px solid rgba(167,139,250,.25);border-radius:4px;padding:1px 5px;margin-left:5px;vertical-align:middle;font-weight:500;letter-spacing:.3px}
.ci-price{font-size:11px;color:var(--tx3);font-family:var(--mo);margin-top:1px}
.ci-total{font-size:13px;font-family:var(--mo);color:var(--tx);font-weight:500;flex-shrink:0}
.qty-ctrl{display:flex;align-items:center;gap:5px;flex-shrink:0}
.qty-btn{width:22px;height:22px;border:1px solid var(--bd2);background:var(--bg4);color:var(--tx2);border-radius:6px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .1s;font-size:14px}
.qty-btn:hover{border-color:var(--go);color:var(--go);background:var(--gd)}
.qty-num{font-family:var(--mo);font-size:12.5px;color:var(--tx);min-width:18px;text-align:center}

/* CART FOOTER */
.cart-footer{padding:14px 18px;border-top:1px solid var(--bd);flex-shrink:0}
.total-row{display:flex;justify-content:space-between;align-items:baseline;margin-bottom:12px}
.total-label{font-size:12px;color:var(--tx3)}
.total-amount{font-size:22px;font-weight:600;font-family:var(--mo);color:var(--tx);letter-spacing:-.5px}
.pay-wrap{position:relative;margin-bottom:8px}
.pay-prefix{position:absolute;left:11px;top:50%;transform:translateY(-50%);font-size:12px;color:var(--tx3);font-family:var(--mo);pointer-events:none}
.pay-input{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px 9px 32px;font-family:var(--mo);font-size:14px;outline:none;transition:border .14s}
.pay-input:focus{border-color:var(--go)}
.pay-input::placeholder{color:var(--tx3);font-size:12.5px;font-family:var(--fn)}
.change-row{display:flex;justify-content:space-between;background:var(--gnd);border:1px solid rgba(62,207,142,.18);border-radius:var(--rs);padding:7px 11px;margin-bottom:10px;opacity:0;transition:opacity .2s}
.change-row.show{opacity:1}
.change-label{font-size:11.5px;color:var(--gn)}
.change-val{font-family:var(--mo);font-size:13px;color:var(--gn);font-weight:500}

/* DEBT INPUT (muncul saat bayar kurang) */
.debt-input-section{background:var(--rdd);border:1px solid rgba(248,113,113,.2);border-radius:var(--rs);padding:10px 12px;margin-bottom:10px;display:none}
.debt-input-section.show{display:block}
.debt-input-section .dl{font-size:10.5px;color:var(--rd);text-transform:uppercase;letter-spacing:.6px;font-weight:500;margin-bottom:7px;display:flex;align-items:center;gap:5px}
.debt-input-section .dl svg{width:12px;height:12px}
.debt-note-inp{width:100%;background:var(--bg4);border:1px solid rgba(248,113,113,.2);color:var(--tx);border-radius:var(--rx);padding:7px 10px;font-family:var(--fn);font-size:12px;outline:none;transition:border .14s;resize:none;min-height:52px}
.debt-note-inp:focus{border-color:var(--rd)}
.debt-note-inp::placeholder{color:var(--tx3)}
.debt-amount-disp{font-family:var(--mo);font-size:13px;color:var(--rd);font-weight:500;margin-top:5px}

.pay-btn{width:100%;padding:12px;background:var(--go);color:#09090b;border:none;border-radius:var(--rr);cursor:pointer;font-family:var(--fn);font-size:14px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .14s}
.pay-btn:hover{background:var(--go2)}
.pay-btn:active{transform:scale(.98)}
.pay-btn:disabled{background:var(--bg4);color:var(--tx3);cursor:not-allowed;transform:none}
.pay-btn svg{width:15px;height:15px}

/* MODAL edit item */
.modal-ov{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:50;display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.modal-ov.on{display:flex}
.modal{background:var(--bg2);border:1px solid var(--bd2);border-radius:14px;width:340px;padding:22px;box-shadow:var(--shl)}
.modal-ttl{font-size:14.5px;font-weight:500;margin-bottom:4px}
.modal-sub{font-size:12px;color:var(--tx3);margin-bottom:18px}
.modal-close{position:absolute;top:0;right:0} /* handled via button */
.m-fg{margin-bottom:14px}
.m-fl{font-size:10.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;display:block;margin-bottom:6px}
.m-fi{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px;font-family:var(--mo);font-size:14px;outline:none;transition:border .14s}
.m-fi:focus{border-color:var(--go)}
.price-opts{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px}
.price-opt{border:1px solid var(--bd2);background:var(--bg3);border-radius:var(--rs);padding:9px 11px;cursor:pointer;transition:all .14s}
.price-opt.sel{border-color:var(--go);background:var(--gd)}
.price-opt-lbl{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px}
.price-opt.sel .price-opt-lbl{color:var(--go);opacity:.7}
.price-opt-val{font-family:var(--mo);font-size:13.5px;font-weight:500;color:var(--tx)}
.price-opt.sel .price-opt-val{color:var(--go)}
.modal-btns{display:flex;gap:8px;margin-top:16px}
.mb-cancel{flex:1;padding:9px;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:13px;transition:all .14s}
.mb-cancel:hover{background:var(--bg5);color:var(--tx)}
.mb-save{flex:2;padding:9px;background:var(--go);border:none;color:#09090b;border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:13px;font-weight:600;transition:all .14s}
.mb-save:hover{background:var(--go2)}

/* TOAST */
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px 11px 13px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s cubic-bezier(.34,1.56,.64,1);z-index:200;min-width:230px;box-shadow:var(--shl)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}
.toast.info .t-dot{background:var(--pu)}
.spin{width:14px;height:14px;border:2px solid rgba(9,9,11,.25);border-top-color:#09090b;border-radius:50%;animation:sp .55s linear infinite;display:inline-block}
@keyframes sp{to{transform:rotate(360deg)}}

/* ONLINE ORDERS */
.orders-btn{display:flex;align-items:center;gap:6px;padding:6px 12px;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:12.5px;font-weight:500;transition:all .14s;position:relative}
.orders-btn:hover{border-color:var(--go);color:var(--go);background:var(--gd)}
.orders-btn svg{width:15px;height:15px}
.sound-btn{display:flex;align-items:center;justify-content:center;width:34px;height:34px;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rs);cursor:pointer;transition:all .14s;padding:0}
.sound-btn:hover{border-color:var(--go);color:var(--go)}
.sound-btn.off{opacity:.45}
.sound-btn svg{width:15px;height:15px}
.orders-badge{position:absolute;top:-6px;right:-6px;min-width:18px;height:18px;padding:0 5px;border-radius:9px;background:var(--rd);color:#fff;font-size:10px;font-weight:600;display:none;align-items:center;justify-content:center}
.orders-badge.show{display:inline-flex}
.modal.orders-modal{width:min(520px,calc(100vw - 32px));max-height:85vh;display:flex;flex-direction:column;padding:0;overflow:hidden}
.orders-modal-head{padding:18px 20px 14px;border-bottom:1px solid var(--bd);flex-shrink:0}
.orders-modal-body{padding:12px 20px 20px;overflow-y:auto;flex:1}
.order-card{background:var(--bg3);border:1px solid var(--bd);border-radius:var(--rr);padding:14px;margin-bottom:10px}
.order-card-head{display:flex;justify-content:space-between;gap:10px;margin-bottom:8px}
.order-no{font-family:var(--mo);font-size:12px;color:var(--go);font-weight:500}
.order-status{font-size:10px;text-transform:uppercase;letter-spacing:.6px;padding:2px 8px;border-radius:10px;background:var(--gd);color:var(--go)}
.order-status.processing{background:var(--pud);color:var(--pu)}
.order-meta{font-size:12px;color:var(--tx2);line-height:1.5;margin-bottom:8px}
.order-items-preview{font-size:11.5px;color:var(--tx3);margin-bottom:10px}
.order-actions{display:flex;gap:8px;flex-wrap:wrap}
.oa-btn{padding:7px 12px;border-radius:var(--rs);border:1px solid var(--bd2);background:var(--bg4);color:var(--tx2);cursor:pointer;font-family:var(--fn);font-size:12px;font-weight:500;transition:all .14s}
.oa-btn:hover{border-color:var(--go);color:var(--go)}
.oa-btn.primary{background:var(--go);border-color:var(--go);color:#09090b}
.oa-btn.primary:hover{background:var(--go2)}
.oa-btn.danger:hover{border-color:var(--rd);color:var(--rd);background:var(--rdd)}
.orders-empty{text-align:center;padding:32px 16px;color:var(--tx3);font-size:13px}
.order-source-banner{margin:0 18px 10px;padding:9px 12px;background:var(--gd);border:1px solid var(--gd2);border-radius:var(--rs);font-size:11.5px;color:var(--go);display:none;align-items:center;gap:8px;line-height:1.4}
.order-source-banner.show{display:flex}

/* RESPONSIVE — lebar keranjang pakai px tetap (aman di Chrome) */
@media (max-width:1200px){
  .app:not(.cart-collapsed){--cart-w:280px;--main-min:240px}
  .product-grid{grid-template-columns:repeat(auto-fill,minmax(108px,1fr))}
}
@media (max-width:1000px){
  .app:not(.cart-collapsed){--cart-w:250px;--main-min:220px}
  .topbar{padding:0 14px}
  .search-area{padding:12px 14px}
  .product-area{padding:12px 14px}
}
@media (max-width:800px){
  .app:not(.cart-collapsed){--cart-w:220px;--main-min:200px}
  .product-grid{grid-template-columns:repeat(auto-fill,minmax(96px,1fr))}
  .p-card-name{font-size:11.5px}
  .price-mode span:not(.pm-dot){display:none}
}
@media (max-width:700px){
  .app:not(.cart-collapsed){--cart-w:200px;--main-min:180px}
  .product-grid{grid-template-columns:repeat(auto-fill,minmax(88px,1fr))}
}
/* Layar sangat kecil: stack vertikal, keduanya tetap terbuka */
@media (max-width:580px){
  .app{
    grid-template-columns:1fr;
    grid-template-rows:minmax(0,1fr) auto;
    grid-template-areas:"main" "cart";
  }
  .main{min-height:0}
  .cart-panel{
    width:100%;max-width:none;
    max-height:40vh;
    border-left:none;
    border-top:1px solid var(--bd);
  }
  .app.cart-collapsed .cart-panel{max-height:48px}
  .app.cart-collapsed .cart-tab{
    flex-direction:row;justify-content:center;
    padding:10px 16px;height:48px;gap:12px;
  }
  .app.cart-collapsed .cart-tab-lbl{writing-mode:horizontal-tb;transform:none}
}
</style>
</head>
<body>
<div class="sb-backdrop" id="sb-backdrop" onclick="closeSidebar()"></div>
<div class="app" id="app">

<!-- SIDEBAR -->
<aside class="sb" id="sb">
<div class="sb-logo"><div class="logo"><div class="logo-ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg></div><div class="logo-txt"><div class="logo-name">TOKO AJIB</div><div class="logo-tag">Point of Sale</div></div></div></div>
<nav class="nav">
  <div class="nav-sec">Utama</div>
  <a href="/dashboard" class="nav-a on" title="Kasir"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg><span class="nav-txt">Kasir</span></a>
  <a href="/online-orders" class="nav-a" title="Riwayat Pesanan Online"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg><span class="nav-txt">Pesanan Online</span></a>
  <a href="/settings/order" class="nav-a" title="Pengaturan Order"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2"/></svg><span class="nav-txt">Pengaturan Order</span></a>
  <a href="/products" class="nav-a" title="Produk"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg><span class="nav-txt">Produk</span></a>
  <a href="/transactions" class="nav-a" title="Transaksi"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg><span class="nav-txt">Transaksi</span></a>
  <a href="/customers" class="nav-a" title="Pelanggan"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg><span class="nav-txt">Pelanggan</span></a>
  <a href="/nonmember" class="nav-a" title="Harga Non-Member"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="18" y1="8" x2="23" y2="13"/><line x1="23" y1="8" x2="18" y2="13"/></svg><span class="nav-txt">Harga Non-Member</span></a>
  <div class="nav-sec">Sistem</div>
  <a href="/import" class="nav-a" title="Import CSV"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg><span class="nav-txt">Import CSV</span></a>
</nav>
<div class="sb-foot"><div class="u-row"><div class="uav">{{ substr(auth()->user()->name??'A',0,1) }}</div><div class="u-info"><div class="u-nm">{{ auth()->user()->name??'Admin' }}</div><div class="u-rl">Kasir</div></div></div></div>
</aside>

<!-- MAIN -->
<main class="main">
  <div class="topbar">
    <button type="button" class="layout-btn" id="sb-toggle" onclick="toggleSidebar()" title="Menu / Sidebar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
    <div class="topbar-ttl">Kasir</div>
    <button type="button" class="orders-btn" id="orders-btn" onclick="openOrdersModal()" title="Pesanan online masuk">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      Pesanan
      <span class="orders-badge" id="orders-badge">0</span>
    </button>
    <button type="button" class="sound-btn" id="sound-btn" onclick="toggleOrderSound()" title="Notifikasi suara pesanan">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 010 14.14M15.54 8.46a5 5 0 010 7.07"/></svg>
    </button>
    <div class="price-mode pm-member" id="price-mode">
      <span class="pm-dot"></span>
      <span id="price-mode-txt">Harga Member</span>
    </div>
    <div class="clock" id="clock">--:--</div>
  </div>

  <!-- SEARCH -->
  <div class="search-area">
    <select id="product-select" style="width:100%">
      <option value="">Cari & tambah produk...</option>
      @foreach($products as $p)
      <option value="{{ $p->id }}"
        data-pcs="{{ $p->harga_jual_pcs }}"
        data-dus="{{ $p->harga_jual_dus }}"
        data-nm-pcs="{{ isset($p->harga_nonmember_pcs) && $p->harga_nonmember_pcs ? $p->harga_nonmember_pcs : $p->harga_jual_pcs }}"
        data-nm-dus="{{ isset($p->harga_nonmember_dus) && $p->harga_nonmember_dus ? $p->harga_nonmember_dus : $p->harga_jual_dus }}">
        {{ $p->name }}
      </option>
      @endforeach
    </select>
    <div class="price-type-row">
      <button class="price-btn on" id="btn-pcs" onclick="setPriceType('pcs')">Satuan (PCS)</button>
      <button class="price-btn" id="btn-dus" onclick="setPriceType('dus')">Per Dus</button>
    </div>
    <button class="add-btn" onclick="addToCart()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
      Tambah ke Keranjang
    </button>
  </div>

  <!-- PRODUCT GRID -->
  <div class="product-area">
    <div class="sec-label">Klik produk untuk tambah ke keranjang</div>
    <div class="product-grid" id="product-grid">
      @foreach($products as $p)
      <div class="p-card"
        @php
          $nmPcs = isset($p->harga_nonmember_pcs) && $p->harga_nonmember_pcs ? $p->harga_nonmember_pcs : $p->harga_jual_pcs;
          $nmDus = isset($p->harga_nonmember_dus) && $p->harga_nonmember_dus ? $p->harga_nonmember_dus : $p->harga_jual_dus;
        @endphp
        onclick="quickAdd({{ $p->id }}, {{ $p->harga_jual_pcs }}, {{ $p->harga_jual_dus }}, {{ $nmPcs }}, {{ $nmDus }})"
        data-id="{{ $p->id }}" data-cat="{{ $p->category_id }}">
        <div class="p-card-stock {{ $p->stock <= 5 ? 'low' : '' }}">{{ $p->stock }}</div>
        <div class="p-card-cat">{{ $p->category->name ?? '—' }}</div>
        <div class="p-card-name">{{ $p->name }}</div>
        <div class="p-card-price">Rp {{ number_format($p->harga_jual_pcs,0,',','.') }}</div>
        <div class="p-card-price-nm">Rp {{ number_format($nmPcs,0,',','.') }}</div>
      </div>
      @endforeach
    </div>
  </div>
</main>

<!-- CART PANEL -->
<aside class="cart-panel" id="cart-panel">
  <button type="button" class="cart-tab" onclick="toggleCart(false)" title="Buka keranjang">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
    <span class="cart-tab-badge" id="cart-tab-badge">0</span>
    <span class="cart-tab-lbl">Keranjang</span>
  </button>
  <div class="cart-inner">
  <div class="cart-header">
    <div class="cart-header-left">
      <div class="cart-ttl">Keranjang</div>
      <div class="cart-count" id="cart-count">0 item</div>
    </div>
    <div class="cart-header-actions">
    <button type="button" class="layout-btn" onclick="toggleCart(true)" title="Sembunyikan keranjang">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
    </button>
    <button type="button" class="cart-reset" id="reset-btn" onclick="resetCart()" disabled title="Kosongkan keranjang & mulai transaksi baru">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
      Reset
    </button>
    </div>
  </div>

  <!-- PELANGGAN -->
  <div class="cust-section">
    <div class="sec-ttl">Pelanggan</div>
    <select id="customer" class="cust-select" onchange="onCustomerChange()">
      <option value="">— Tanpa Pelanggan (Non-Member) —</option>
      @foreach($customers as $c)
      <option value="{{ $c->id }}" data-debt="{{ $c->total_debt ?? 0 }}">
        {{ $c->name }}{{ ($c->total_debt ?? 0) > 0 ? ' ⚠ Ada Utang' : '' }}
      </option>
      @endforeach
    </select>
  </div>

  <!-- DEBT WARNING -->
  <div class="debt-warn" id="debt-warn">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    <span id="debt-warn-msg">Pelanggan ini memiliki utang aktif.</span>
  </div>

  <!-- PESANAN ONLINE BANNER -->
  <div class="order-source-banner" id="order-source-banner">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
    <span id="order-source-text">Keranjang dari pesanan online</span>
  </div>

  <!-- MANUAL PRODUCT -->
  <div class="manual-section">
    <button type="button" class="manual-btn" onclick="openManualModal()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
      Produk Manual
    </button>
  </div>

  <!-- CART ITEMS -->
  <div class="cart-items" id="cart-list">
    <div class="cart-empty">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      <p>Keranjang kosong</p>
    </div>
  </div>

  <!-- CART FOOTER -->
  <div class="cart-footer">
    <div class="total-row">
      <div class="total-label">Total Bayar</div>
      <div class="total-amount">Rp <span id="grand-total">0</span></div>
    </div>
    <div class="pay-wrap">
      <div class="pay-prefix">Rp</div>
      <input type="number" id="paid" class="pay-input" placeholder="Nominal uang bayar" oninput="calcChange()">
    </div>
    <div class="change-row" id="change-row">
      <span class="change-label">Kembalian</span>
      <span class="change-val" id="change-val">Rp 0</span>
    </div>
    <!-- DEBT INPUT — muncul saat bayar kurang -->
    <div class="debt-input-section" id="debt-input-section">
      <div class="dl">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Pembayaran Kurang — Akan Dicatat Sebagai Utang
      </div>
      <div class="debt-amount-disp" id="debt-amount-disp">Kekurangan: Rp 0</div>
      <textarea class="debt-note-inp" id="debt-note" rows="2" placeholder="Catatan utang (opsional)..." style="margin-top:7px"></textarea>
    </div>
    <button class="pay-btn" id="pay-btn" onclick="checkout()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
      Bayar & Cetak Struk
    </button>
  </div>
  </div>
</aside>
</div>

<!-- MODAL EDIT ITEM -->
<div class="modal-ov" id="modal-ov">
  <div class="modal">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:4px">
      <div class="modal-ttl">Edit Item</div>
      <button onclick="closeModal()" style="background:none;border:none;color:var(--tx3);cursor:pointer;padding:2px">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-sub" id="modal-sub">Edit nama, qty &amp; harga</div>
    <input type="hidden" id="modal-id">
    <div class="m-fg">
      <label class="m-fl">Nama Produk</label>
      <input class="m-fi" type="text" id="modal-name-inp" placeholder="Nama produk">
    </div>
    <div class="price-opts" id="modal-price-opts">
      <div class="price-opt" id="opt-pcs" onclick="selectOpt('pcs')">
        <div class="price-opt-lbl">Harga PCS</div>
        <div class="price-opt-val" id="opt-pcs-val">—</div>
      </div>
      <div class="price-opt" id="opt-dus" onclick="selectOpt('dus')">
        <div class="price-opt-lbl">Harga Dus</div>
        <div class="price-opt-val" id="opt-dus-val">—</div>
      </div>
    </div>
    <div class="m-fg">
      <label class="m-fl">Jumlah (Qty)</label>
      <input class="m-fi" type="number" id="modal-qty" min="1" oninput="onQtyChange()">
    </div>
    <div class="m-fg">
      <label class="m-fl">Harga Manual</label>
      <input class="m-fi" type="number" id="modal-price">
    </div>
    <div class="modal-btns">
      <button class="mb-cancel" onclick="closeModal()">Batal</button>
      <button class="mb-save" onclick="saveModal()">Simpan</button>
    </div>
  </div>
</div>

<!-- MODAL PRODUK MANUAL -->
<div class="modal-ov" id="manual-modal-ov">
  <div class="modal">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:4px">
      <div class="modal-ttl">Produk Manual</div>
      <button onclick="closeManualModal()" style="background:none;border:none;color:var(--tx3);cursor:pointer;padding:2px">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-sub">Tambah item dengan nama &amp; harga bebas</div>
    <div class="m-fg">
      <label class="m-fl">Nama Produk</label>
      <input class="m-fi" type="text" id="manual-name" placeholder="Contoh: Jasa pasang, Barang titip">
    </div>
    <div class="m-fg">
      <label class="m-fl">Harga</label>
      <input class="m-fi" type="number" id="manual-price" min="0" placeholder="0">
    </div>
    <div class="m-fg">
      <label class="m-fl">Jumlah (Qty)</label>
      <input class="m-fi" type="number" id="manual-qty" min="1" value="1">
    </div>
    <div class="modal-btns">
      <button class="mb-cancel" onclick="closeManualModal()">Batal</button>
      <button class="mb-save" onclick="addManualProduct()">Tambah ke Keranjang</button>
    </div>
  </div>
</div>

<!-- MODAL PESANAN ONLINE -->
<div class="modal-ov" id="orders-modal-ov" onclick="if(event.target===this)closeOrdersModal()">
  <div class="modal orders-modal">
    <div class="orders-modal-head">
      <div style="display:flex;justify-content:space-between;align-items:flex-start">
        <div>
          <div class="modal-ttl">Pesanan Online</div>
          <div class="modal-sub">Verifikasi & muat ke keranjang kasir</div>
        </div>
        <button onclick="closeOrdersModal()" style="background:none;border:none;color:var(--tx3);cursor:pointer;padding:2px">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
    </div>
    <div class="orders-modal-body" id="orders-list">
      <div class="orders-empty">Memuat pesanan...</div>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"><div class="t-dot"></div><span id="t-msg"></span></div>

<script>
@verbatim

const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const Rp   = n => new Intl.NumberFormat('id-ID').format(Math.round(n));
const g    = id => document.getElementById(id);
const esc  = s => String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/"/g,'&quot;');
const cartIdJs = id => JSON.stringify(String(id));

let priceType   = 'pcs';   // 'pcs' | 'dus'
let isMember    = false;   // apakah pelanggan dipilih
let grandTotal  = 0;
let cartItemCount = 0;
let currentItem = {};

const LAYOUT_KEY = 'pos_layout_v3';

function getLayoutPrefs() {
    try {
        const prefs = JSON.parse(localStorage.getItem(LAYOUT_KEY))
            || JSON.parse(localStorage.getItem('pos_layout_v2'))
            || JSON.parse(localStorage.getItem('pos_layout_v1'))
            || {};
        if (prefs.cartManual === undefined) {
            prefs.cartManual = prefs.cartCollapsed === true ? true : null;
        }
        return prefs;
    } catch { return {}; }
}

function saveLayoutPrefs(prefs) {
    localStorage.setItem(LAYOUT_KEY, JSON.stringify(prefs));
}

function migrateLayoutPrefs() {
    if (localStorage.getItem(LAYOUT_KEY)) return;
    saveLayoutPrefs({ cartManual: null, sbOpen: false });
}

function isStackLayout() {
    return window.innerWidth <= 580;
}

function resolveCartCollapsed(prefs) {
    return prefs.cartManual === true;
}

function applyLayout() {
    const app = g('app');
    if (!app) return;

    const prefs = getLayoutPrefs();
    const cartCollapsed = resolveCartCollapsed(prefs);

    app.classList.toggle('cart-collapsed', cartCollapsed);
    app.classList.toggle('sb-open', !!prefs.sbOpen);
    app.classList.toggle('layout-stack', isStackLayout());

    const backdrop = g('sb-backdrop');
    if (backdrop) backdrop.classList.toggle('show', !!prefs.sbOpen);

    const sbBtn = g('sb-toggle');
    if (sbBtn) {
        sbBtn.title = prefs.sbOpen ? 'Tutup menu' : 'Buka menu';
    }
}

function toggleSidebar() {
    const prefs = getLayoutPrefs();
    prefs.sbOpen = !prefs.sbOpen;
    saveLayoutPrefs(prefs);
    applyLayout();
}

function closeSidebar() {
    const prefs = getLayoutPrefs();
    if (!prefs.sbOpen) return;
    prefs.sbOpen = false;
    saveLayoutPrefs(prefs);
    applyLayout();
}

function toggleCart(collapsed) {
    const prefs = getLayoutPrefs();
    if (collapsed === true) prefs.cartManual = true;
    else if (collapsed === false) prefs.cartManual = false;
    else prefs.cartManual = !resolveCartCollapsed(prefs);
    saveLayoutPrefs(prefs);
    applyLayout();
}

let layoutResizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(layoutResizeTimer);
    layoutResizeTimer = setTimeout(applyLayout, 120);
});

// ── CLOCK ──────────────────────────────────────────────
setInterval(() => { g('clock').textContent = new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'}); }, 1000);

// ── SELECT2 ────────────────────────────────────────────
$(document).ready(function() {
    migrateLayoutPrefs();
    applyLayout();
    $('#product-select').select2({ placeholder:'Cari produk...', width:'100%', dropdownParent:$('.search-area') });
    $('#product-select').on('select2:select', () => addToCart());
    loadCart();
    refreshOrdersBadge();
    setInterval(refreshOrdersBadge, 15000);
    applySoundBtn();
});

// ── PRICE TYPE ─────────────────────────────────────────
function setPriceType(t) {
    priceType = t;
    g('btn-pcs').classList.toggle('on', t==='pcs');
    g('btn-dus').classList.toggle('on', t==='dus');
}

// ── CUSTOMER CHANGE ────────────────────────────────────
function onCustomerChange() {
    const sel  = g('customer');
    const opt  = sel.options[sel.selectedIndex];
    isMember   = !!sel.value;
    const debt = parseFloat(opt?.dataset?.debt ?? 0);

    // Update price mode indicator
    const pm = g('price-mode');
    pm.className = 'price-mode ' + (isMember ? 'pm-member' : 'pm-nonmember');
    g('price-mode-txt').textContent = isMember ? 'Harga Member' : 'Harga Non-Member';

    // Update product grid label
    const grid = g('product-grid');
    if (isMember) grid.classList.remove('nm-mode');
    else          grid.classList.add('nm-mode');

    // Debt warning
    const warn = g('debt-warn');
    if (isMember && debt > 0) {
        g('debt-warn-msg').textContent = `Pelanggan ini memiliki utang aktif: Rp ${Rp(debt)}`;
        warn.classList.add('show');
    } else {
        warn.classList.remove('show');
    }

    showToast(isMember ? '🟢 Mode Harga Member aktif' : '🟣 Mode Harga Non-Member aktif', 'info');
    updateResetBtn();
}

// ── ADD TO CART ────────────────────────────────────────
function getPrice(option) {
    if (isMember) {
        return priceType === 'pcs'
            ? option.dataset.pcs
            : option.dataset.dus;
    } else {
        return priceType === 'pcs'
            ? option.dataset.nmPcs
            : option.dataset.nmDus;
    }
}

function addToCart() {
    const sel = document.getElementById('product-select');
    const id  = sel.value;
    if (!id) return;
    const opt   = sel.options[sel.selectedIndex];
    const price = getPrice(opt);
    doAdd(id, price);
    $('#product-select').val(null).trigger('change');
}

function quickAdd(id, pricePcs, priceDus, nmPcs, nmDus) {
    const price = isMember
        ? (priceType==='pcs' ? pricePcs : priceDus)
        : (priceType==='pcs' ? nmPcs    : nmDus);
    doAdd(id, price);
}

function doAdd(id, price) {
    fetch('/cart/add', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
        body: JSON.stringify({ product_id:id, price }),
    }).then(r=>r.json()).then(d => {
        if (d.status==='success') { loadCart(); showToast('Produk ditambahkan','ok'); }
        else showToast(d.message||'Gagal','err');
    });
}

function cartEntries(cart) {
    return Object.entries(cart).sort((a, b) => (a[1].order ?? 0) - (b[1].order ?? 0));
}

// ── LOAD CART ──────────────────────────────────────────
function updateResetBtn() {
    const hasCart = cartItemCount > 0;
    const hasForm = !!g('customer').value
        || (parseInt(g('paid').value) || 0) > 0
        || !!g('debt-note').value.trim();
    g('reset-btn').disabled = !hasCart && !hasForm;
}

function resetCartForm() {
    g('customer').value = '';
    onCustomerChange();
    g('paid').value = '';
    g('debt-note').value = '';
    g('change-row').classList.remove('show');
    g('debt-input-section').classList.remove('show');
    grandTotal = 0;
    g('grand-total').textContent = '0';
    cartItemCount = 0;
    updateResetBtn();
}

async function resetCart() {
    if (!confirm('Kosongkan keranjang dan reset semua data transaksi?')) return;

    const btn = g('reset-btn');
    btn.disabled = true;

    try {
        const res = await fetch('/cart/clear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
        });
        const data = await res.json();
        if (data.status !== 'success') {
            showToast(data.message || 'Gagal reset keranjang', 'err');
            return;
        }
        resetCartForm();
        loadCart();
        refreshOrdersBadge();
        showToast('Transaksi baru — keranjang dikosongkan', 'ok');
    } catch (e) {
        showToast('Gagal terhubung ke server', 'err');
        console.error(e);
    }
}

function loadCart() {
    fetch('/cart-data').then(r=>r.json()).then(data => {
        grandTotal = data.grandTotal;
        const items = data.cart;
        const count = Object.keys(items).length;
        cartItemCount = count;

        g('cart-count').textContent = count + ' item';
        if (g('cart-tab-badge')) g('cart-tab-badge').textContent = count;
        g('grand-total').textContent = Rp(grandTotal);
        calcChange();
        updateResetBtn();
        updateOrderBanner(data.pending_order);

        const el = g('cart-list');
        if (count === 0) {
            el.innerHTML = `<div class="cart-empty"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg><p>Keranjang kosong</p></div>`;
            return;
        }

        let html = '';
        for (const [id, item] of cartEntries(items)) {
            const idJs = cartIdJs(id);
            const badge = item.custom ? '<span class="ci-badge">Manual</span>' : '';
            html += `<div class="cart-item" onclick="openModal(${idJs})">
                <div class="ci-info">
                  <div class="ci-name">${esc(item.name)}${badge}</div>
                  <div class="ci-price">${item.qty} × Rp ${Rp(item.price)}</div>
                </div>
                <div class="qty-ctrl" onclick="event.stopPropagation()">
                  <button class="qty-btn" onclick="updateQty(${idJs},'minus')">−</button>
                  <span class="qty-num">${item.qty}</span>
                  <button class="qty-btn" onclick="updateQty(${idJs},'plus')">+</button>
                </div>
                <div class="ci-total">Rp ${Rp(item.price*item.qty)}</div>
            </div>`;
        }
        el.innerHTML = html;
    });
}

function updateQty(id, action) {
    fetch(`/cart/update/${encodeURIComponent(id)}/${action}`).then(r=>r.json()).then(() => loadCart());
}

// ── CHANGE CALC ────────────────────────────────────────
function calcChange() {
    const paid    = parseInt(g('paid').value) || 0;
    const change  = paid - grandTotal;
    const deficit = grandTotal - paid;

    // Kembalian
    const cr = g('change-row');
    if (paid > 0 && change >= 0) {
        g('change-val').textContent = 'Rp ' + Rp(change);
        cr.classList.add('show');
    } else {
        cr.classList.remove('show');
    }

    // Debt section — tampil kalau bayar kurang & ada pelanggan
    const ds = g('debt-input-section');
    const custId = g('customer').value;
    if (paid > 0 && paid < grandTotal && custId) {
        g('debt-amount-disp').textContent = 'Kekurangan: Rp ' + Rp(deficit);
        ds.classList.add('show');
    } else if (paid > 0 && paid < grandTotal && !custId) {
        ds.classList.remove('show');
        // Hint pilih pelanggan
    } else {
        ds.classList.remove('show');
    }

    updateResetBtn();
}

// ── CHECKOUT ───────────────────────────────────────────
async function checkout() {
    const paid    = parseInt(g('paid').value) || 0;
    const custId  = g('customer').value;
    const deficit = grandTotal - paid;
    const btn     = g('pay-btn');

    if (!paid)   { showToast('Masukkan nominal uang bayar','err'); return; }
    if (!custId) { showToast('Pilih pelanggan terlebih dahulu','err'); return; }
    if (paid < grandTotal && !custId) {
        showToast('Pilih pelanggan untuk mencatat kekurangan sebagai utang','err'); return;
    }

    btn.disabled = true;
    btn.innerHTML = '<div class="spin"></div>';

    try {
        const res = await fetch('/checkout-ajax', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
            body: JSON.stringify({
                paid,
                customer_id: custId,
                debt_note:   deficit > 0 ? (g('debt-note').value || `Kekurangan pembayaran`) : null,
            }),
        });
        const data = await res.json();
        if (data.status==='error') { showToast(data.message,'err'); return; }

        // Buka struk
        window.open('/receipt/'+data.sale_id, '_blank');

        if (data.whatsapp_url) {
            if (confirm('Kirim struk ke WhatsApp pelanggan?')) {
                window.open(data.whatsapp_url, '_blank');
            }
        }

        // Notifikasi utang
        if (data.has_debt) {
            showToast(`Transaksi berhasil. Utang Rp ${Rp(data.debt_amount)} dicatat.`, 'info');
        } else if (data.order_number) {
            showToast(`Pesanan ${data.order_number} selesai!`, 'ok');
        } else {
            showToast('Transaksi berhasil!','ok');
        }
        // Reset penuh untuk transaksi baru
        resetCartForm();
        loadCart();
        refreshOrdersBadge();
    } catch(e) { showToast('Gagal terhubung ke server','err'); console.error(e); }
    finally {
        btn.disabled = false;
        btn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="15" height="15"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg> Bayar & Cetak Struk`;
    }
}

// ── MODAL EDIT ─────────────────────────────────────────
function openModal(id) {
    fetch('/cart-data').then(r=>r.json()).then(data => {
        const item = data.cart[id];
        if (!item) return;
        currentItem = item;

        const isCustom = !!item.custom || String(id).startsWith('custom_');

        g('modal-id').value = id;
        g('modal-name-inp').value = item.name;
        g('modal-qty').value = item.qty;
        g('modal-price').value = item.price;
        g('modal-price-opts').style.display = isCustom ? 'none' : 'grid';
        g('modal-sub').textContent = isCustom ? 'Produk manual — edit nama, qty & harga' : 'Edit nama, qty & harga';

        if (!isCustom) {
            g('opt-pcs-val').textContent = 'Rp '+Rp(item.harga_pcs||0);
            g('opt-dus-val').textContent = 'Rp '+Rp(item.harga_dus||0);

            const isPcs = item.price == item.harga_pcs;
            g('opt-pcs').classList.toggle('sel', isPcs);
            g('opt-dus').classList.toggle('sel', !isPcs);

            g('opt-pcs').onclick = () => { g('modal-price').value = currentItem.harga_pcs||0; g('opt-pcs').classList.add('sel'); g('opt-dus').classList.remove('sel'); };
            g('opt-dus').onclick = () => { g('modal-price').value = currentItem.harga_dus||0; g('opt-dus').classList.add('sel'); g('opt-pcs').classList.remove('sel'); };
        }

        g('modal-ov').classList.add('on');
    });
}
function closeModal() { g('modal-ov').classList.remove('on'); }
function onQtyChange() {
    if (currentItem.custom || String(g('modal-id').value).startsWith('custom_')) return;
    const qty = parseInt(g('modal-qty').value)||1;
    if (qty >= 12) { g('modal-price').value = currentItem.harga_dus||0; g('opt-dus').classList.add('sel'); g('opt-pcs').classList.remove('sel'); }
    else           { g('modal-price').value = currentItem.harga_pcs||0; g('opt-pcs').classList.add('sel'); g('opt-dus').classList.remove('sel'); }
}
function selectOpt(type) {
    g('opt-pcs').classList.toggle('sel', type==='pcs');
    g('opt-dus').classList.toggle('sel', type==='dus');
    g('modal-price').value = type==='pcs' ? (currentItem.harga_pcs||0) : (currentItem.harga_dus||0);
}
function saveModal() {
    const name = g('modal-name-inp').value.trim();
    if (!name) { showToast('Nama produk wajib diisi','err'); return; }

    fetch('/cart/update-manual', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
        body: JSON.stringify({
            id: g('modal-id').value,
            name,
            qty: g('modal-qty').value,
            price: g('modal-price').value,
        }),
    }).then(()=>{ closeModal(); loadCart(); showToast('Keranjang diperbarui','ok'); });
}

// ── MODAL PRODUK MANUAL ────────────────────────────────
function openManualModal() {
    g('manual-name').value = '';
    g('manual-price').value = '';
    g('manual-qty').value = '1';
    g('manual-modal-ov').classList.add('on');
    setTimeout(() => g('manual-name').focus(), 50);
}
function closeManualModal() { g('manual-modal-ov').classList.remove('on'); }
function addManualProduct() {
    const name  = g('manual-name').value.trim();
    const price = parseInt(g('manual-price').value) || 0;
    const qty   = parseInt(g('manual-qty').value) || 1;

    if (!name)  { showToast('Nama produk wajib diisi','err'); return; }
    if (price <= 0) { showToast('Harga harus lebih dari 0','err'); return; }
    if (qty < 1) { showToast('Qty minimal 1','err'); return; }

    fetch('/cart/add-manual', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
        body: JSON.stringify({ name, price, qty }),
    }).then(r=>r.json()).then(d => {
        if (d.status === 'success') {
            closeManualModal();
            loadCart();
            showToast('Produk manual ditambahkan','ok');
        } else {
            showToast(d.message || 'Gagal menambahkan produk','err');
        }
    });
}

// ── ONLINE ORDERS ────────────────────────────────────
let lastKnownLatestOrderId = null;
let orderPollInitialized = false;
let orderSoundEnabled = localStorage.getItem('pos_order_sound') !== '0';

function applySoundBtn() {
    const btn = g('sound-btn');
    if (!btn) return;
    btn.classList.toggle('off', !orderSoundEnabled);
    btn.title = orderSoundEnabled ? 'Matikan suara pesanan' : 'Nyalakan suara pesanan';
}

function toggleOrderSound() {
    orderSoundEnabled = !orderSoundEnabled;
    localStorage.setItem('pos_order_sound', orderSoundEnabled ? '1' : '0');
    applySoundBtn();
    showToast(orderSoundEnabled ? 'Suara pesanan aktif' : 'Suara pesanan dimatikan', 'info');
}

function playOrderSound() {
    try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        [880, 1100].forEach((freq, i) => {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.frequency.value = freq;
            const t = ctx.currentTime + i * 0.15;
            gain.gain.setValueAtTime(0.12, t);
            gain.gain.exponentialRampToValueAtTime(0.01, t + 0.25);
            osc.start(t);
            osc.stop(t + 0.25);
        });
    } catch (e) {}
}

function updateOrderBanner(pendingOrder) {
    const banner = g('order-source-banner');
    const text   = g('order-source-text');
    if (!banner || !text) return;

    if (pendingOrder?.order_number) {
        text.textContent = `Keranjang dari pesanan ${pendingOrder.order_number} — verifikasi lalu bayar`;
        banner.classList.add('show');
    } else {
        banner.classList.remove('show');
    }
}

function updateOrdersBadge(count) {
    const badge = g('orders-badge');
    if (!badge) return;
    badge.textContent = count;
    badge.classList.toggle('show', count > 0);
}

async function refreshOrdersBadge() {
    try {
        const res = await fetch('/pos/orders/count', { headers: { 'Accept': 'application/json' } });
        const data = await res.json();
        const count = data.count || 0;
        const latestId = data.latest_id || null;

        if (orderPollInitialized && latestId && lastKnownLatestOrderId !== null && latestId > lastKnownLatestOrderId) {
            if (orderSoundEnabled) playOrderSound();
            showToast('Pesanan online baru masuk!', 'info');
        }

        if (latestId) lastKnownLatestOrderId = latestId;
        orderPollInitialized = true;
        updateOrdersBadge(count);
    } catch (e) {}
}

function openOrdersModal() {
    closeSidebar();
    g('orders-modal-ov').classList.add('on');
    loadPendingOrders();
}

function closeOrdersModal() {
    g('orders-modal-ov').classList.remove('on');
}

async function loadPendingOrders() {
    const el = g('orders-list');
    el.innerHTML = '<div class="orders-empty">Memuat pesanan...</div>';

    try {
        const res = await fetch('/pos/orders', { headers: { 'Accept': 'application/json' } });
        const data = await res.json();
        updateOrdersBadge(data.count || 0);
        if (data.latest_id) lastKnownLatestOrderId = data.latest_id;

        if (!data.orders?.length) {
            el.innerHTML = '<div class="orders-empty">Belum ada pesanan online masuk.<br><span style="font-size:12px;margin-top:8px;display:block">Bagikan link: ' + esc(window.location.origin + '/order') + '</span></div>';
            return;
        }

        el.innerHTML = data.orders.map(o => `
            <div class="order-card">
              <div class="order-card-head">
                <div class="order-no">${esc(o.order_number)}</div>
                <div class="order-status ${o.status === 'processing' ? 'processing' : ''}">${esc(o.status)}</div>
              </div>
              <div class="order-meta">
                <strong>${esc(o.customer_name)}</strong><br>
                ${esc(o.customer_phone)}${o.customer_address ? '<br>' + esc(o.customer_address) : ''}
                ${o.notes ? '<br><em>Catatan: ' + esc(o.notes) + '</em>' : ''}
              </div>
              <div class="order-items-preview">${esc(o.items_preview || '')} · ${o.item_count} item · ${esc(o.created_at || '')}</div>
              <div class="order-actions">
                <button type="button" class="oa-btn primary" onclick="loadOrderToCart(${o.id})">Muat ke Keranjang</button>
                <button type="button" class="oa-btn danger" onclick="cancelOnlineOrder(${o.id})">Tolak</button>
              </div>
            </div>
        `).join('');
    } catch (e) {
        el.innerHTML = '<div class="orders-empty">Gagal memuat pesanan</div>';
    }
}

async function loadOrderToCart(orderId) {
    if (!confirm('Muat pesanan ke keranjang? Keranjang saat ini akan diganti.')) return;

    try {
        const res = await fetch('/pos/orders/' + orderId + '/load', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        });
        const data = await res.json();

        if (data.status !== 'success') {
            showToast(data.message || 'Gagal memuat pesanan', 'err');
            return;
        }

        if (data.customer_id) {
            g('customer').value = data.customer_id;
            onCustomerChange();
        }

        closeOrdersModal();
        loadCart();
        refreshOrdersBadge();
        toggleCart(false);

        let msg = `Pesanan ${data.order_number} dimuat ke keranjang`;
        if (data.warnings?.length) msg += ' (' + data.warnings.length + ' item dilewati)';
        showToast(msg, 'ok');
    } catch (e) {
        showToast('Gagal terhubung ke server', 'err');
    }
}

async function cancelOnlineOrder(orderId) {
    if (!confirm('Batalkan pesanan ini?')) return;

    try {
        const res = await fetch('/pos/orders/' + orderId + '/cancel', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        });
        const data = await res.json();

        if (data.status !== 'success') {
            showToast(data.message || 'Gagal membatalkan', 'err');
            return;
        }

        showToast('Pesanan dibatalkan', 'info');
        loadPendingOrders();
        loadCart();
    } catch (e) {
        showToast('Gagal terhubung ke server', 'err');
    }
}

// ── TOAST ──────────────────────────────────────────────
function showToast(msg, type='ok') {
    const t=g('toast'); g('t-msg').textContent=msg;
    t.className=`toast ${type} on`;
    clearTimeout(t._t); t._t=setTimeout(()=>t.classList.remove('on'),2800);
}

// Close modal on ESC
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeModal();
        closeManualModal();
        closeOrdersModal();
        closeSidebar();
    }
});

@endverbatim
</script>
</body>
</html>
