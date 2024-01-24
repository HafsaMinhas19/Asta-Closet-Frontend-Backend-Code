<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
  <section class="manage-employee">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="align-items-center crud-employee d-flex gap-4 my-4">
            <button>
              <a href="../Asta-Closet-Admin-/assets/manage-employees/add-employee.html">Add Employee <i
                  class="fa-solid fa-user-plus"></i></a>
            </button>
            <button>
              <a href="../Asta-Closet-Admin-/assets/manage-employees/delete-employee.html">Delete Employee <i
                  class="fa-solid fa-user-slash"></i></a>
            </button>
            <button>
              <a href="../Asta-Closet-Admin-/assets/manage-employees/update-employee.html">Update Employee <i
                  class="fa-solid fa-user-pen"></i></a>
            </button>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Employee ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Position</th>
                <th scope="col">Department</th>
                <th scope="col">Employment Status</th>
                <th scope="col">Salary</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">01</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>Male</td>
                <td>CEO</td>
                <td>Board of Director</td>
                <td id="active">Active</td>
                <td>1Lac</td>
              </tr>
              <tr>
                <th scope="row">02</th>
                <td>Ali</td>
                <td>Ahmed</td>
                <td>Male</td>
                <td>Sales Associate Manager</td>
                <td>Sales and Marketing</td>
                <td id="in-active">In Active</td>

                <td>50K</td>
              </tr>
              <tr>
                <th scope="row">03</th>
                <td>Ahmed</td>
                <td>Mark</td>
                <td>Male</td>
                <td>Accountant</td>
                <td>Finance and Accounting</td>
                <td id="active">Active</td>
                <td>30K</td>
              </tr>
              <tr>
                <th scope="row">04</th>
                <td>Bilal</td>
                <td>Ahmed</td>
                <td>Male</td>
                <td>Social Media Manager</td>
                <td>Digital Marketing</td>
                <td id="active">Active</td>
                <td>70K</td>
              </tr>
              <tr>
                <th scope="row">05</th>
                <td>Rohail</td>
                <td>Ajmal</td>
                <td>Male</td>
                <td>Customer Service Provider</td>
                <td>Customer Service</td>
                <td id="active">Active</td>
                <td>50K</td>
              </tr>
              <tr>
                <th scope="row">06</th>
                <td>Ayesha</td>
                <td>Zaviyar</td>
                <td>Female</td>
                <td>Product Manager</td>
                <td>Product Management</td>
                <td id="in-active">In Active</td>

                <td>1 Lac</td>
              </tr>
              <tr>
                <th scope="row">07</th>
                <td>Mark</td>
                <td>Ahmed</td>
                <td>Male</td>
                <td>Software Engineer</td>
                <td>Technology and IT</td>
                <td id="active">Active</td>
                <td>1 Lac</td>
              </tr>
              <tr>
                <th scope="row">08</th>
                <td>Akmal</td>
                <td>Abdullah</td>
                <td>Male</td>
                <td>UI/UX Designer</td>
                <td>Technology and IT</td>
                <td id="in-active">In Active</td>
                <td>1 Lac</td>
              </tr>
              <tr>
                <th scope="row">09</th>
                <td>Mark</td>
                <td>Usman</td>
                <td>Male</td>
                <td>Software Quality Engineer</td>
                <td>Quality Assurance and Testing</td>
                <td id="active">Active</td>
                <td>1 Lac</td>
              </tr>
              <tr>
                <th scope="row">10</th>
                <td>Amir</td>
                <td>Khan</td>
                <td>Male</td>
                <td>HR Manager</td>
                <td>Human Resource Management</td>
                <td id="active">Active</td>
                <td>1 Lac</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?php require "includes/scripts.php"; ?>
</body>

</html>