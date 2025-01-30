export function downloadTable(type){

  document.querySelector(`.${type}-table-button`).addEventListener('click', async (event) => {
    document.querySelector('.table-section').innerHTML = '';
    const response = await fetch(`http://logs-table-reader-mvc/public/logs/table?type=${type}`).then(response => response.text());
    document.querySelector('.table-section').innerHTML = response;
  })
}