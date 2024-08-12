 
  const ctx = document.getElementById('chart1');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['female', 'male' ],
      datasets: [{
        label: '# of Votes',
        data: [12, 19 ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
 
