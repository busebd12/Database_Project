<!--
Authored by: Brendan Busey and Jarrett Horne
-->

<html>

<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">

      <div class="col-md-10">

        <div class="jumbotron">

          <div class="row">
            <h1>
              Welcome to our U.S. Trade Data Database
            </h1>
            <p>
              Please select the data options for your query below
            </p>
          </div>

        </div>
      </div>

    </div>

  <form  id="form" action="ConnectToDatabase.php" method="post">

  <div class="form-group">

    <label for="Year" style="text-indent: 60px">Year</label>
    <div class="year-field" style="width: 500px; margin-left: 60px;">
    <input type="input" required="true" name="year" class="form-control" id="Year" placeholder="Please only enter dates between 1960 through 2014">
    </div>

  </div>
  <div class="checkbox" style="text-indent: 30px">
    <label>
      <input type="checkbox" name="total-exports-checkbox" id="Exports"> Total Exports
    </label>
  </div>

  <div class="checkbox" style="text-indent: 30px">
    <label>
      <input type="checkbox" name="goods-exported-checkbox" id="Exports"> Goods Exported
    </label>
  </div>

  <div class="checkbox" style="text-indent: 30px">
    <label>
      <input type="checkbox" name="services-exported-checkbox" id="Services"> Services Exported
    </label>
  </div>

  <div class="checkbox" style="text-indent: 30px">
    <label>
      <input type="checkbox" name="total-imports-checkbox" id="Imports"> Total Imports
    </label>
  </div>

  <div class="checkbox" style="text-indent: 30px">
    <label>
      <input type="checkbox" name="goods-imported-checkbox" id="Imports"> Goods Imported
    </label>
  </div>

  <div class="checkbox" style="text-indent: 30px">
    <label>
      <input type="checkbox" name="services-imported-checkbox" id="Exports"> Services Imported
    </label>
  </div>

  <div class="checkbox" style="text-indent: 30px">
    <label>
      <input type="checkbox" name="total-imports-exports-checkbox" id="Show-Balance"> Total Imports and Exports
    </label>
  </div>

  <div class="submit-button" style="text-indent: 60px">
  <button type="submit" class="btn btn-default">Submit</button>
  </div>
</form>

<br>
<br>
<br>

</body>
</html>