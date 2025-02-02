import { appendDelete } from '../utils/append.element.js';
import { deleteLog } from './deleteLog.logfile.js';
const server = 'https://apachebackend.lorenzo-viganego.com/logs-table-reader-mvc/public/';
const local = 'http://logs-table-reader-mvc/public/'

export function downloadTable(type, resolve = false, reject = false){
  let tableBool = false;
  document.querySelector(`.${type}-table-button`).addEventListener('click', async (event) => {
    document.querySelector('.table-section').innerHTML = '';
    const response = await fetch(`${server}logs/table?type=${type}`)

    if (response.status >= 200 && response.status < 400) {
      tableBool = true;
      const result = await response.text();
      let table = document.querySelector('.table-section')
      table.innerHTML = result;
      appendDelete(table)
      if (resolve) {
        resolve()
      }
    } else if (response.status >= 400 && response.status < 500 ){
      const error = response;
      return error
    } else {
      const error = response;
      return error;
    }
  })
}

export async function downloadTable2(type) {
  let tableBool = false;
  document.querySelector('.table-section').innerHTML = '';
  const response = await fetch(`${server}logs/table?type=${type}`)

  if (response.status >= 200 && response.status < 400) {
    tableBool = true;;
    const result = await response.text();
    let table = document.querySelector('.table-section')
    table.innerHTML = result;
    appendDelete(table)
    deleteLog(type);
  } else if (response.status >= 400 && response.status < 500 ){
    const error = response;
    return error
  } else {
    const error = response;
    return error;
  }
}