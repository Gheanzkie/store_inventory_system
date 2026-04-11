document.addEventListener("DOMContentLoaded", function () {

    const containers = document.querySelectorAll("[id^='items-']");

    containers.forEach(container => {
        const saleId = container.id.replace("items-", "");
        loadItems(saleId, container);
    });

});

function loadItems(saleId, container) {

    fetch(BASE_URL + "/sales_items/getSaleItems/" + saleId)
        .then(res => res.json())
        .then(data => {

            if (!data.length) {
                container.innerHTML = "<small class='text-muted'>No items found</small>";
                return;
            }

            let html = `
                <table class="table table-sm table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            let total = 0;

            data.forEach(item => {
                total += parseFloat(item.subtotal);

                html += `
                    <tr>
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>₱${parseFloat(item.subtotal).toFixed(2)}</td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">TOTAL</th>
                            <th>₱${total.toFixed(2)}</th>
                        </tr>
                    </tfoot>
                </table>
            `;

            container.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            container.innerHTML = "<small class='text-danger'>Error loading items</small>";
        });
}