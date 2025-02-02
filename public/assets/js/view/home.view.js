import { appendTable } from '../utils/append.element.js';
import { downloadLogFile } from '../services/download.logfile.js';
import { deleteLog } from '../services/deleteLog.logfile.js';
import { downloadTable } from '../services/download.table.js';

document.addEventListener('submit', async (event) => {
  event.preventDefault();
  try {
  const formData = new FormData(event.target);
  const type = formData.getAll('type')[0];
  const response = await fetch(`http://logs-table-reader-mvc/public/logs/${type}`, {
    method: 'POST',
    body: formData
  });

  if (response.status >= 200 && response.status < 400) {
    const result = await response.json();
    const displayBool = appendTable(result);
    if (!displayBool) throw new Error("Error 404");
    downloadLogFile(type);
    new Promise((resolve, reject) => {
      downloadTable(type, resolve, reject);
    }).then(() => {
      deleteLog(type);
      

    }).catch((error) => {
      throw new Error(error);
    })  

  } else if (response.status >= 400 && response.status < 500 ){
    const error = response;
    throw new Error(response);
  } else {
    const error = response;
    throw new Error(response);
  }
  } catch (err) {
    console.error(err)
  }
})