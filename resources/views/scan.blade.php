<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.container {
    display: flex;
}
.left {
    width: 50%;
}
.right {
    width: 50%;
    padding: 10px;
}
</style>

<div class="container">

    <!-- 🔵 SCANNER -->
    <div class="left">
        <h3>Scanner</h3>
        <div id="scanner" style="width:100%"></div>
    </div>

    <!-- 🟢 CART -->
    <div class="right">
        <h3>Keranjang</h3>

        <table border="1" width="100%" id="cart-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h3>Total: <span id="grand-total">0</span></h3>
    <hr>

<h3>Pembayaran</h3>

<input type="number" id="paid" placeholder="Uang bayar">

<br><br>

<button onclick="checkout()">Bayar</button>

<h3>Kembalian: <span id="change">0</span></h3>
    </div>

</div>

<audio id="beep-sound" src="https://www.soundjay.com/buttons/beep-07.mp3"></audio>

<script src="https://unpkg.com/quagga/dist/quagga.min.js"></script>

<script>
function beep() {
    try {
        let audio = document.getElementById('beep-sound');
        if(audio) {
            audio.currentTime = 0;
            audio.play().catch(() => {});
        }
    } catch(e) {
        console.log("beep error:", e);
    }
}

function cartEntries(cart) {
    return Object.entries(cart).sort((a, b) => (b[1].order ?? 0) - (a[1].order ?? 0));
}

function renderCart(cart, grandTotal) {
    let tbody = document.querySelector('#cart-table tbody');
    tbody.innerHTML = '';

    for (const [id, item] of cartEntries(cart)) {

        let row = `
            <tr>
                <td>${item.name}</td>
                <td>
                    <button onclick="updateQty(${id}, 'minus')">-</button>
                    ${item.qty}
                    <button onclick="updateQty(${id}, 'plus')">+</button>
                </td>
                <td>${item.price * item.qty}</td>
            </tr>
        `;

        tbody.innerHTML += row;
    }

    document.getElementById('grand-total').innerText = grandTotal;
}

function updateQty(id, action) {
    fetch(`/cart/update/${id}/${action}`)
    .then(res => res.json())
    .then(data => {
        renderCart(data.cart, data.grandTotal);
    });
}

let scanning = true;

Quagga.init({
    inputStream: {
        name: "Live",
        type: "LiveStream",
        target: document.querySelector('#scanner'),
        constraints: {
            facingMode: "environment"
        },
    },
    decoder: {
        readers: ["ean_reader"]
    }
}, function(err) {
    if (err) {
        console.log(err);
        return;
    }
    Quagga.start();
});

Quagga.onDetected(function(result) {
    if(!scanning) return;

    scanning = false;

    let code = result.codeResult.code;

    console.log("SCAN:", code);

    fetch('/scan/' + code)
    .then(res => res.json())
    .then(data => {

        if(data.status === 'success') {
            beep();
            renderCart(data.cart, data.grandTotal);
        } else {
            console.log("Produk tidak ditemukan");
        }

    })
    .catch(err => console.log("FETCH ERROR:", err))
    .finally(() => {
        setTimeout(() => scanning = true, 1000);
    });
});


</script>