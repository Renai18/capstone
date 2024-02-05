<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        

    </style>
</head>

<body>
   <!-- Create button with a custom image -->
   <button id="createButton" onclick="createDraggableTextbox()">
        <img src="create.png" alt="Create">
        Create
        <button id="printButton" onclick="printPage()">
        <img src="printing.png" alt="Print">
        Print
    </button>

       <!-- Draggable container for Trash with a picture -->
<div id="div4" ondrop="drop(event)" ondragover="allowDrop(event)">
    <img src="trash-bin.png" alt="Trash">
    <p>Trash</p>
</div>

<button id="goBackButton" onclick="goBack()">Go Back to Homepage</button>

<script>
    function goBack() {
        window.location.href = 'home.php'; // Change 'index.html' to the actual file path of your index.html
    }
</script>

    <!-- Container for the table -->
    <div id="tableContainer">
        <!-- Draggable table -->
        <table class="grid-container">
            <!-- table content here -->
            <thead>
                <tr>
                    <br>
                    <th>Time</th>
                    <th>3A</th>
                    <th>3B</th>
                    <th>3C</th>
                    <th>2A</th>
                    <th>2B</th>
                    <th>2C</th>
                    <th>2D</th>
                    <th>2E</th>
                    <th>LAB1 </th>
                    <th>LAB2</th>
                    <th>LIB</th>
                    <th>ANX-A</th>
                    <th>ANX-B</th>
                    <th>ANX-C</th>
                    <th>ANX-D</th>
                    <th>ANX-E</th>
                    <th>ANX-G</th>
                    <th>ANX-H</th>
                    <th>ANX-I</th>
                    <!-- Add more room headers as needed -->
                </tr>
            </thead>
            <tbody id="grid-body">
                <!-- PHP code for table rows -->
                 <?php
                for ($hour = 7; $hour <= 18; $hour++) {
                    echo '<tr>';
                    echo '<td>' . formatTime($hour) . ' - ' . formatTime($hour + 1) . '</td>';
                    echo '<td ondrop="drop(event)" ondragover="allowDrop(event)"></td>';
                    for ($room = 1; $room <= 18; $room++) {
                        echo '<td ondrop="drop(event)" ondragover="allowDrop(event)"></td>';
                    }
                    echo '</tr>';
                }
                function formatTime($hour)
                {
                    $formattedHour = $hour % 12 == 0 ? 12 : $hour % 12;
                    $amPm = $hour < 12 ? 'am' : 'pm';
                    return $formattedHour . ':00 ' . $amPm;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Draggable and editable container -->
    <div id="draggableTextbox" draggable="true" ondragstart="drag(event)" contenteditable="true">
        <!-- Initial content inside the text box -->
        <p>I'm the Original, Use the button below me to clone me</p>
    </div>

 

    <script>
        function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var draggedElement = document.getElementById(data);

    if (ev.target.tagName === 'TD') {
        var targetCell = ev.target;
        var targetRow = targetCell.parentNode;

        // Check if the dragged content already exists in the row
        if (hasSimilarContentInRow(draggedElement.innerText, targetRow)) {
            // Highlight the entire row in red
            highlightRow(targetRow);
        } else {
            // Remove the highlight from all rows
            removeRowHighlight();

            // Remove the dragged element from its original location
            draggedElement.parentNode.removeChild(draggedElement);
            // Append the element to the drop target
            targetCell.appendChild(draggedElement);
        }
    } else if (ev.target.id === 'div3') {
        // Append the element to the drop target
        ev.target.appendChild(draggedElement);
    } else if (ev.target.id === 'div4') {
        // Remove the highlight from all rows
        removeRowHighlight();

        // Remove the dragged element (delete it)
        draggedElement.parentNode.removeChild(draggedElement);
    }
}

// Function to highlight the row in red
function highlightRow(row) {
    row.style.backgroundColor = 'red';
}

// Function to remove the highlight from all rows
function removeRowHighlight() {
    var rows = document.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        rows[i].style.backgroundColor = '';
    }
}

// Function to check if the content already exists in the row
function hasSimilarContentInRow(content, row) {
    // Get all cells in the row
    var cells = row.getElementsByTagName('td');

    // Check if the content already exists in any cell in the row
    for (var i = 0; i < cells.length; i++) {
        if (isSimilarContent(content, cells[i].innerText)) {
            return true;
        }
    }

    return false;
}

// Function to check if content is similar
function isSimilarContent(content1, content2) {
    return content1.trim().toLowerCase() === content2.trim().toLowerCase();
}

// ... (rest of your code)

function createDraggableTextbox() {
    // Clone the draggable textbox
    var originalDraggableTextbox = document.getElementById('draggableTextbox');
    var newDraggableTextbox = originalDraggableTextbox.cloneNode(true);

    // Set a unique ID for the new textbox
    var newId = 'draggableTextbox' + new Date().getTime();
    newDraggableTextbox.id = newId;

    // Set a unique content for the new textbox
    var uniqueContent = 'I\'m a new textbox - ' + new Date().getTime();
    newDraggableTextbox.querySelector('p').innerText = uniqueContent;

    // Make the new textbox draggable
    newDraggableTextbox.draggable = true;

    // Set the drag event for the new textbox
    newDraggableTextbox.ondragstart = function (event) {
        drag(event);
    };

    // Apply similar styles to the new textbox
    newDraggableTextbox.style.border = originalDraggableTextbox.style.border;
    newDraggableTextbox.style.padding = originalDraggableTextbox.style.padding;
    newDraggableTextbox.style.cursor = originalDraggableTextbox.style.cursor;

    // Set a lower z-index to make it appear below other elements
    newDraggableTextbox.style.zIndex = 1;

    // Append the new textbox to the body
    document.body.appendChild(newDraggableTextbox);
}


        function printPage() {
            window.print();
        }
    </script>
</body>

</html>












