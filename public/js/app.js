const address = document.querySelector('.address')

const btnAdd = document.querySelector('.btn-add')

btnAdd.addEventListener('click', function () {
    address.innerHTML += `<div class="address">
    <div class="mb-3">
        <label for="address_street" class="form-label">Address Street</label>
        <input type="text" class="form-control" id="address_street" name="addresses[0][street]">
    </div>
    <div class="mb-3">
        <label for="address_ward" class="form-label">Ward</label>
        <input type="text" class="form-control" id="address_ward" name="addresses[0][ward]">
    </div>
    <div class="mb-3">
        <label for="address_district" class="form-label">District</label>
        <input type="text" class="form-control" id="address_district" name="addresses[0][district]">
    </div>
    <div class="mb-3">
        <label for="address_province" class="form-label">Province</label>
        <input type="text" class="form-control" id="address_province" name="addresses[0][province]">
    </div>
</div>`
})