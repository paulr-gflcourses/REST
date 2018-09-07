<h2>Pre order car</h2>

<div class="row">

    <form name="carorder" class="col-lg-5" id="carorder" action="javascript:void(0);">
        <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>"/>

        <label for="name">Name</label>
        <input type="text" class="form-control"
                           name="name" id="name" value="" placeholder="Enter your Name">

        <label for="surname">Surname</label>
        <input type="text" class="form-control"
                           name="surname" id="surname" value="" placeholder="Enter your Surname">

        <label for="paytype">Select type pay</label>
        <select class="form-control" name="paytype" id="paytype">
            <option value="credit card">Credit card</option>
            <option value="cash">Cash</option>
        </select>
        <button type="submit" class="btn btn-warning"
                              onclick="order()">Order</button>

        <div class="text-danger" id="errorsOrderForm"></div> 
    </form>
</div>
