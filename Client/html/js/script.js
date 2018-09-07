const url=`http://192.168.0.15/~user12/soap/task2/client/index.php`;
let results = document.getElementById("results");

function getCarList() {
    let formData = {
        'action': 'getCarList'
    };
    $.post(url, formData, function (data) {
        showOnTable(data)
    }, "json");
}

function getDetails(id) {
    let formData = {
        'action': 'getById',
        'id': id
    };
    $.post(url, formData, function (data) {
        showOnDetails(data)
    }, "json");
}

function searchCars() {
    let formData = {
        'filter': {
            'mark': $('select[name=mark]').val(),
            'model': $('input[name=model]').val(),
            'year': $('input[name=year]').val(),
            'engine': $('input[name=engine]').val(),
            'color': $('select[name=color]').val(),
            'maxspeed': $('input[name=maxspeed]').val(),
            'price': $('input[name=price]').val(),
        },
        'action': 'searchCars'
    };
    $.post(url, formData, function (data) {
        showOnTable(data);
    }, "json");

}

function order() {

    let formData = {
        'action': 'order',
        'orderData': {
            'idcar': $('input[name=id]').val(),
            'firstname': $('input[name=name]').val(),
            'lastname': $('input[name=surname]').val(),
            'payment': $('select[name=paytype]').val(),
        }
    };
    if (formData.orderData.firstname && formData.orderData.lastname){
        $.post(url, formData, function (data) {
            if (data['errors']) {
                results.innerHTML = '<h3 class="text-danger">Error: ' + data.errors + '</h3>';
            } else {
                let id = data.id;
                results.innerHTML = "<h3 class='text-success'>The car with id=" + id + " is successfully ordered!</h3>";
            }
        }, "json");
    }else{
        let errorMsg="";
        if (!formData.orderData.firstname){
            errorMsg += "<p>The name is empty!</p>";
        }
        if (!formData.orderData.lastname){
            errorMsg += "<p>The surname is empty!</p>";
        }
        document.getElementById("errorsOrderForm").innerHTML = errorMsg;
    }

}

function getOrderForm(id) {
    let formData = {
        'action': 'getOrderForm',
        'id': id
    };
    $.post(url, formData, function (data) {
        results.innerHTML = data;
    }, "html");
}

function showOnTable(data) {
    if (data.length != 0) {
        if (data['errors']) {
            results.innerHTML = '<h3 class="text-danger">Error: ' + data.errors + '</h3>';
        } else {
            let table = carsListToTable(data);
            results.innerHTML = table;
        }
    } else {
        results.innerHTML = '<h3>No cars found.</h3>';
    }
    document.getElementById("details").innerHTML = "";
}

function showOnDetails(entry) {
    let t = document.getElementById("details");
    let table = objToTable(entry);
    let html = "<h3>Car details</h3>" + table;
    t.innerHTML = html;
}


function carsListToTable(cars) {
    let table = '<table class="table" id="table">';
    if (cars.length) {
        table += '<tr class="row">';
        table += '<th class="col-lg-1">id</th> <th class="col-lg-4">mark</th> ' +
            '<th class="col-lg-5">model</th> <th class="col-lg-1"></th> <th class="col-lg-1"></th>';
        table += '</tr>';
        for (let i in cars) {
            let id = cars[i]['id'];
            table += '<tr class="row">';
            table += '<td class="col-lg-1">' + id + '</td> <td class="col-lg-4">' +
                cars[i]['mark'] + '</td> <td class="col-lg-5">' + cars[i]['model'] + '</td>';
            table += '<td class="col-lg-1">' +
                '<button type="submit" class="btn btn-primary"' +
                'onclick="getDetails(' + id + ')">Details</button>' +
                '</td>';
            table += '<td class="col-lg-1">' +
                '<button type="submit" class="btn btn-danger"' +
                'onclick="getOrderForm(' + id + ')">Order</button>' +
                '</td>';
            table += '</tr>';
        }
        table += '</table>';
    }
    return table;
}

function objToTable(o) {
    let table = '<table class="table" id="table">';
    if (o.length) {
        table += '<tr>';
        for (key in o[0]) {
            table += '<th>' + key + '</th>';
        }
        table += '</tr>';
        for (row in o) {
            table += '<tr>';
            for (cell in o[row]) {
                table += '<td>' + o[row][cell] + '</td>';
            }
            table += '</tr>';
        }
    } else {
        table += '<tr>';
        for (key in o) {
            table += '<th>' + key + '</th>';
        }
        table += '</tr>';

        table += '<tr>';
        for (key in o) {
            table += '<td>' + o[key] + '</td>';
        }
        table += '</tr>';
    }
    table += '</table>';
    return table;
}
