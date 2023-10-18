@extends('layout')
@section('title', 'Diet')

@section('content')
<style>
    .table-head > td {
        font-weight: 600;
        padding-bottom: 10px;
    }
    .table-body > tr > td {
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
        padding-top: 10px;
    }
</style>
<div class="webfeed-wrapper">
    <div class="regular-content">
   <form class="form" autocomplete="off" method="POST" enctype="multipart/form-data" action="{{route('timeline.add_handle')}}">
        <h1>Find Diet</h1>
        <div class="field">
            <label>Food name</label>
            <input type="text" placeholder="Meat" id="food-name" required />
        </div>
        <div class="field">
            <label>Minimum value for calories</label>
            <input type="number"  id="min_calories"  />
        </div>
        <div class="field">
            <label>Max value for calories</label>
            <input type="number"  id="max_calories"  />
        </div>
        <div class="field">
            <label>Minimum value for carbohidrates</label>
            <input type="number"  id="min_carbohidrates"  />
        </div>
        <div class="field">
            <label>Max value for carbohidrates</label>
            <input type="number"  id="max_carbohidrates"  />
        </div>
        <div class="field">
            <label>Minimum value for fat</label>
            <input type="number"  id="min_fat"  />
        </div>
        <div class="field">
            <label>Max value for fat</label>
            <input type="number"  id="max_fat"  />
        </div>
        <div class="button-wrapper">
            @csrf
            <button class="button">Find</button>
        </div>
    </form>
    <div class="result">
        <table class="tbl">
            <thead>
                <tr class="table-head">
                    <td>Meal Name</td>
                    <td>Calories</td>
                    <td>Carbohidrates</td>
                    <td>Fat</td>
                </tr>
            </thead>
            <tbody class="table-body" id="result-tbody">
            </tbody>
        </table>    
    </div>
</div>
@endsection
@section('js')
<script>
    // This function will make the API call and update the table with the results
async function fetchNutritionalData() {
  const foodName = document.getElementById('food-name').value;
  const minCalories = document.getElementById('min_calories').value;
  const maxCalories = document.getElementById('max_calories').value;
  const minCarbohidrates = document.getElementById('min_carbohidrates').value;
  const maxCarbohidrates = document.getElementById('max_carbohidrates').value;
  const minFat = document.getElementById('min_fat').value;
  const maxFat = document.getElementById('max_fat').value;

  // Initialize an empty query string
  let queryString = '';

  // Build the query string based on the form field values
  if (foodName) {
    queryString += `&name=${foodName}`;
  }
  if (minCalories) {
    queryString += `&min_calories=${minCalories}`;
  }
  if (maxCalories) {
    queryString += `&max_calories=${maxCalories}`;
  }
  if (minCarbohidrates) {
    queryString += `&min_carbohidrates=${minCarbohidrates}`;
  }
  if (maxCarbohidrates) {
    queryString += `&max_carbohidrates=${maxCarbohidrates}`;
  }
  if (minFat) {
    queryString += `&min_fat=${minFat}`;
  }
  if (maxFat) {
    queryString += `&max_fat=${maxFat}`;
  }

  // Remove the leading "&" if the query string is not empty
  if (queryString) {
    queryString = '?' + queryString.substring(1);
  }

  // Build the final URL
  const url = `https://nutritional-data.p.rapidapi.com/${queryString}`;

  const headers = new Headers({
    'X-RapidAPI-Key': 'cfc2963a22msh2fb627f1c57cdd7p13a546jsn31599eabcc92',
    'X-RapidAPI-Host': 'nutritional-data.p.rapidapi.com',
  });

  try {
    const response = await fetch(url, { method: 'GET', headers });
    const data = await response.json();

    const result = data.result;

    // Get a reference to the table body
    const tableBody = document.getElementById('result-tbody');
    tableBody.innerHTML = ''; // Clear previous results

    // Loop through the results and add rows to the table
    result.forEach((food) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${food.name}</td>
        <td>${food.calories}</td>
        <td>${food.carbohidrates}</td>
        <td>${food.fat}</td>
      `;
      tableBody.appendChild(row);
    });
  } catch (error) {
    console.error(error);
  }
}

// Add an event listener to the "Find" button
const findButton = document.querySelector('.button');
findButton.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent the form submission
  fetchNutritionalData();
});

</script>
@endsection
