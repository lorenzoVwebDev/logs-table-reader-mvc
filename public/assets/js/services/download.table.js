import { appendDelete } from '../utils/append.element';

export function downloadTable(type){

  document.querySelector(`.${type}-table-button`).addEventListener('click', async (event) => {
    document.querySelector('.table-section').innerHTML = '';
    const response = await fetch(`http://logs-table-reader-mvc/public/logs/table?type=${type}`).then(response => response.text());
    let table = document.querySelector('.table-section')
    table.innerHTML = response;
    appendDelete(table)
  })
}