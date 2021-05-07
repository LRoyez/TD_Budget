var incomes = document.getElementById('myChart').dataset.incomes;
var expenses = document.getElementById('myChart').dataset.expenses;

var ctx = document.getElementById('myChart').getContext('2d');
const data = {
    labels: [
        'Revenus',
        'Dépenses',
    ],
    datasets: [{
        label: 'My First Dataset',
        data: [incomes, expenses],
        backgroundColor: [
            'rgb(0, 19, 255)',
            'rgb(255, 0, 0 )',
        ],
        hoverOffset: 2
    }]
};
const config = {
    type: 'pie',
    data: data,
};
var myChart = new Chart(ctx, config);
console.log(ctx);
