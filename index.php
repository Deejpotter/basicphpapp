<?php include "templates/header.php"; ?>

<!-- Hero section -->
<section id="hero-section">
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-3">Favourite colour checker</h1>
            <hr>
            <p>Enter the name of a colour below to find other people who like the same one.</p>
            <!-- Input favourite colour name and return a list of data entries that match the colour -->
            <form class="form-inline" action="index.php" method="post">
                <div class="form-group w-100 justify-content-center">
                    <input type="text" name="readFavouriteColour" id="readFavouriteColour" class="form-control w-50" placeholder="Enter colour name...">
                    <input class="btn btn-primary" type="submit" value="Find colour">
                </div>
            </form>
        </div>
    </div>
</section>


<!-- Read section -->
<section id="read-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h2>Results</h2>
                <?php
                if (isset($_POST['submit'])) {
                    echo "<p>Submitted</p>";
                    try {
                        require "../config.php";
                        require "../common.php";

                        $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT *
                                FROM users
                                WHERE favouriteColour = :favouriteColour";

                        $favouriteColour = $_POST['readFavouriteColour'];

                        $statement = $connection->prepare($sql);
                        $statement->bindParam(':favouriteColour', $favouriteColour, PDO::PARAM_STR);
                        $statement->execute();

                        $result = $statement->fetchAll();
                    } catch (PDOException $error) {
                        echo $sql . "<br>" . $error->getMessage();
                    }
                    if ($result && $statement->rowCount() > 0) { ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Favourite Colour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Input new row for each row found in database -->
                                <?php foreach ($result as $row) { ?>
                                    <tr>
                                        <td scope="row"><?php echo escape($row["id"]); ?></td>
                                        <td><?php echo escape($row["firstname"]); ?></td>
                                        <td><?php echo escape($row["lastname"]); ?></td>
                                        <td><?php echo escape($row["favouriteColour"]); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>No results found</p>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</section>

<hr>

<!-- Create section -->
<section id="create-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h2>Create</h2>
                <p>Enter your info to create a new user.</p>
            </div>
            <div class="col-md">
                <!-- Form should submit the details and create a new user in the database -->
                <form class="" action="createUser.php" method="post">
                    <div class="form-group">
                        <label id="createUsernameLabel" for="createUsername">Username:</label>
                        <input type="text" name="createUsername" id="createUsername" class="form-control" placeholder="Sterogrules" aria-labelledby="createUsernameLabel">
                    </div>
                    <div class="form-group">
                        <label id="createFirstNameLabel" for="createFirstName">FirstName:</label>
                        <input type="text" name="createFirstName" id="createFirstName" class="form-control" placeholder="Sterog" aria-labelledby="createFirstNameLabel">
                    </div>
                    <div class="form-group">
                        <label id="createLastNameLabel" for="createLastName">LastName:</label>
                        <input type="text" name="createLastName" id="createLastName" class="form-control" placeholder="Smithson" aria-labelledby="createLastNameLabel">
                    </div>
                    <div class="form-group">
                        <label id="createFavouriteColourLabel" for="createFavouriteColour">Favourite colour:</label>
                        <input type="text" name="createFavouriteColour" id="createFavouriteColour" class="form-control" placeholder="Blue" aria-labelledby="createFavouriteColourLabel">
                    </div>
                    <div class="form-group">
                        <label id="createPasswordLabel" for="createPassword">Password:</label>
                        <input type="password" name="createPassword" id="createPassword" class="form-control" placeholder="x6h27YT5&" aria-labelledby="createPasswordLabel">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Create user">
                </form>
            </div>
        </div>
    </div>
</section>

<hr>

<!-- Update section -->
<section id="update-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="" action="updateUser.php" method="post">
                    <div class="form-group">
                        <label id="updateUsernameLabel" for="updateUsername">Username:</label>
                        <input type="text" name="updateUsername" id="updateUsername" class="form-control" placeholder="Sterogrules" aria-labelledby="updateUsernameLabel">
                    </div>
                    <div class="form-group">
                        <label id="updateFirstNameLabel" for="updateFirstName">FirstName:</label>
                        <input type="text" name="updateFirstName" id="updateFirstName" class="form-control" placeholder="Sterog" aria-labelledby="updateFirstNameLabel">
                    </div>
                    <div class="form-group">
                        <label id="updateLastNameLabel" for="updateLastName">LastName:</label>
                        <input type="text" name="updateLastName" id="updateLastName" class="form-control" placeholder="Smithson" aria-labelledby="updateLastNameLabel">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update user">
                </form>
            </div>
            <div class="col-md-6">
                <h2>Update</h2>
            </div>
        </div>
    </div>
</section>

<hr>

<!-- Delete section -->
<section id="delete-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h2>Delete user</h2>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label id="deleteUsernameLabel" for="deleteUsername">Username:</label>
                    <input type="text" name="deleteUsername" id="deleteUsername" class="form-control" placeholder="Sterogrules" aria-labelledby="deleteUsernameLabel">
                </div>
                <input class="btn btn-primary" type="submit" value="delete user">
            </div>
        </div>
    </div>
</section>

<?php include "templates/footer.php"; ?>