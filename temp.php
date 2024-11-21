<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <style>
        body {
    font-family: 'Cursive', sans-serif;
    background-color: #e0e0e0; /* Light Gray */
    margin: 0;
}

.neumorphic {
    background: #e0e0e0; /* Light Gray */
    box-shadow: 10px 10px 20px #bcbcbc, -10px -10px 20px #ffffff;
}

header, footer {
    background-color: #8b4513; /* Saddle Brown */
    color: #fff;
    text-align: center;
    padding: 1rem 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 16px;
}

.add-item,
.inventory-list {
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

input {
    margin-bottom: 10px;
    padding: 8px;
    border: none;
    background-color: #f0f0f0; /* Lighter Gray */
    box-shadow: inset 6px 6px 10px #c9c9c9, inset -6px -6px 10px #ffffff;
}

button.glassy {
    background-color: #78c7c7; /* Sky Blue */
    color: #fff;
    padding: 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    box-shadow: 6px 6px 10px #c9c9c9, -6px -6px 10px #ffffff;
}

table.glassy {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 6px 6px 10px #c9c9c9, -6px -6px 10px #ffffff;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #8b4513; /* Saddle Brown */
    color: #fff;
}

footer {
    text-align: center;
    padding: 10px 0;
    background-color: #8b4513; /* Saddle Brown */
    color: #fff;
    border-radius: 0 0 16px 16px;
}

    </style>
</head>
<body>

    <header class="neumorphic">
        <h1>Inventory System</h1>
    </header>

    <div class="container neumorphic">
        <section class="add-item">
            <h2>Add New Pastry</h2>
            <form action="#" method="post">
                <label for="pastryName">Pastry Name:</label>
                <input type="text" id="pastryName" name="pastryName" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>

                <button type="submit" class="glassy">Add Pastry</button>
            </form>
        </section>

        <section class="inventory-list">
            <h2>Pastry Inventory</h2>
            <table class="glassy">
                <thead>
                    <tr>
                        <th>Pastry Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows with inventory data go here -->
                    <tr>
                        <td>Croissant</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>Cupcake</td>
                        <td>30</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </section>
    </div>

    <footer class="neumorphic">
        <p>&copy;Inventory Management System</p>
    </footer>

</body>
</html>
