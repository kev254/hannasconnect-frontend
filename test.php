<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Custom Multiselect Dropdown</title>
  <style>
    .multiselect {
      position: relative;
      display: inline-block;
    }

    .select-box {
      position: relative;
      width: 200px;
    }

    #toggle-dropdown {
      display: none;
    }

    #dropdown-label {
      width: 100%;
      background-color: #ccc;
      padding: 10px;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #fff;
      border: 1px solid #ccc;
      max-height: 150px;
      overflow-y: auto;
    }

    .dropdown-content label {
      display: block;
      padding: 5px;
      cursor: pointer;
    }

    #toggle-dropdown:checked + #dropdown-label + .dropdown-content {
      display: block;
    }
  </style>
</head>
<body>
  <div class="multiselect">
    <div class="select-box">
      <input type="checkbox" id="toggle-dropdown">
      <label for="toggle-dropdown" id="dropdown-label">Select Options</label>
      <div class="dropdown-content">
        <label for="option1"><input type="checkbox" id="option1" value="option1"> Option 1</label>
        <label for="option2"><input type="checkbox" id="option2" value="option2"> Option 2</label>
        <label for="option3"><input type="checkbox" id="option3" value="option3"> Option 3</label>
        <label for="option4"><input type="checkbox" id="option4" value="option4"> Option 4</label>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkboxes = document.querySelectorAll('.dropdown-content input[type="checkbox"]');
      const dropdownLabel = document.getElementById('dropdown-label');
      const selectedOptions = [];

      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          if (this.checked) {
            selectedOptions.push(this.value);
          } else {
            const index = selectedOptions.indexOf(this.value);
            if (index !== -1) {
              selectedOptions.splice(index, 1);
            }
          }
          updateDropdownLabel();
        });
      });

      function updateDropdownLabel() {
        if (selectedOptions.length > 0) {
          dropdownLabel.textContent = selectedOptions.join(', ');
        } else {
          dropdownLabel.textContent = 'Select Options';
        }
      }

      const toggleDropdown = document.getElementById('toggle-dropdown');

      toggleDropdown.addEventListener('change', function() {
        if (this.checked) {
          // Dropdown is open; do nothing.
        } else {
          // Dropdown is closed; reset selectedOptions and update the button label.
          selectedOptions.length = 0;
          updateDropdownLabel();
        }
      });
    });
  </script>
</body>
</html>
