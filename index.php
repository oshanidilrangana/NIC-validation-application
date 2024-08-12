 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
     

  <?php
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

    if ($query) {
        while ($row = mysqli_fetch_array($query)) {
            echo $row['name'];
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
    header("Location: login.php#sign_form");
}
?>  
 
<style>
  .container {
      margin-top: 20px;
  }
</style>
        

      <div class="sidebar">
        <h4 class="p-3 fw-bold">Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="profile.html">
                  <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/> 
                  </svg>
                  <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="report()"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4.5V19a1 1 0 0 0 1 1h15M7 10l4 4 4-4 5 5m0 0h-3.207M20 15v-3.207"/>
                </svg>
                
                <span>Report</span></a>
            </li>
             
             
        </ul>
    </div>
    
    <div class="content">
        <h2 id="section1">
          <form id="uploadForm" enctype="multipart/form-data" action="assets/php/dashboard.php">
          <div class="card container ">
            <div class="card-body">
                <div class="file_input">
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label"> Input files  </label>
                        <input class="form-control" type="file" id="formFileMultiple" name="csvFiles[]" accept=".csv" multiple>
                        <button type="submit" id="result" class="btn btn-secondary">submit</button>
                      </div>
                </div>
            </div>
    
        </div>
      </form>
        </h2>

         
         <!-- Content for section 1 -->
        
         
        <h2 id="section2">
          <div class="container">
              <div class="row">
                  <div class="col">
                      <div class="card shadow-2-strong" style="width: 500px">
                          <div class="card-body">
                              <p class="text-uppercase mb-2"><strong>Gender</strong></p>
                              <hr />
                              <div>
                                  <canvas id="chart1"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card shadow-2-strong" style="width: auto">
                          <div class="card-body">
                              <p class="text-uppercase mb-2"><strong>Age groups</strong></p>
                              <hr />
                              <canvas id="chart2" ></canvas>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </h2>
        

        <script>
          document.getElementById('uploadForm').addEventListener('submit', function(event) {
              event.preventDefault();
              
              let formData = new FormData(this);
              
              if (formData.getAll('csvFiles[]').length !== 4) {
                  alert("Please upload exactly four CSV files.");
                  return;
              }
  
              fetch('dashboard.php', {
                  method: 'POST',
                  body: formData
              })
              .then(response => response.json())
              .then(data => {
                  let output = "<h3>Validation Results:</h3><ul>";
                  data.forEach(result => {
                      output += `<li>NIC: ${result.nic} - Birthday: ${result.birthday}, Age: ${result.age}, Gender: ${result.gender}</li>`;
                  });
                  output += "</ul>";
                  document.getElementById('results').innerHTML = output;
              })
              .catch(error => console.error('Error:', error));
          });
      </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
    <script src="assets/js/dashboard/chart1.js"></script>
    <script src="assets/js/dashboard/chart2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
