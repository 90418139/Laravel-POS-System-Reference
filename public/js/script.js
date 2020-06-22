/* ---------------------------------------------------
    DataTables
----------------------------------------------------- */

$(document).ready(function () {
    $('.myTable').DataTable({
        'iDisplayLength': 3,
        'pagingType' : 'simple_numbers',
        'bFilter': false,
        "bInfo": false,
        "bLengthChange": false,
        "bSort": false,
    });
});

/* ---------------------------------------------------
    Order
----------------------------------------------------- */

var item,price;
$('.order_item').click(function (event) {
    event.preventDefault();
    $('#canvas').show();
    item = $(this).find('h4').html();
    item = item.split('<span>')[0];
    price = $(this).find('span').text();
});

function sum_total() {
    tbody = document.getElementById('right_table_body');
    total_cost = 0
    for(i = 0; i < tbody.rows.length; i++){
        total_cost += parseInt(tbody.rows[i].cells[2].innerHTML);
    }
    total = document.getElementById('total');
    total.innerHTML = total_cost;
}
function set_input() {
    var item = '';
    var qty ='';
    var price = '';
    tbody = document.getElementById('right_table_body');
    for(i = 0; i < tbody.rows.length; i++){
        item += tbody.rows[i].cells[0].innerHTML + ',';
        qty += tbody.rows[i].cells[1].innerHTML + ',';
        price += tbody.rows[i].cells[2].innerHTML + ',';
    }
    $('#input_item').val(item);
    $('#input_qty').val(qty);
    $('#input_price').val(price);
}
function item_delete(event) {
    td = event.target;
    td.parentNode.remove();
    sum_total();
    set_input();
}

/* ---------------------------------------------------
    浮動數字輸入框
----------------------------------------------------- */

$('.number').click( function () {
    value = $('#text').html() + $(this).html();
    $('#text').html(value);
});
$('#c').click(function () {
    $('#text').html('');
});
$('#ent').click(function () {
    $('#canvas').hide();
    var qty = $('#text').html();
    price = price * qty;
    var td = "<tr><td>" + item + "</td><td>" + qty + "</td><td>" + price + "</td></tr>";
    $('#right_table_body').append(td);
    sum_total();
    set_input();
    $('#input_user').val($('#table_num').text());
    $('#text').html('');
});

/* ---------------------------------------------------
    Chart.js
----------------------------------------------------- */

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
        },
        legend: {
            display: false,
        }
    }
});


