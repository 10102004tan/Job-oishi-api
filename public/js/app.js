const address = document.querySelector('.address')

const btnAdd = document.querySelector('.btn-add')

btnAdd.addEventListener('click', function () {
    address.innerHTML += `<div class="mb-3">
    <label for="address_street" class="form-label">Address Street</label>
    <input type="text" class="form-control" id="address_id" name="addresses[]">
</div>`
})