import { downloadTable2 } from './download.table';

export function deleteLog(type) {
  document.querySelectorAll('.delete-log').forEach(element => {
    element.addEventListener('click', async (event) => {
      element.dataset.index
      const bodyObject = {
        index: element.dataset.index,
        type: type
      }
      const response = await fetch('http://logs-table-reader-mvc/public/logs/deletelog', {
        method: "POST",
        body: JSON.stringify(bodyObject),
        headers: {
          "Content-Type": "application/json"
        }
      })

      if (response.status >= 200 && response.status < 400) {
        const result = await response.json();
        console.log('hello');
        downloadTable2(type);
      } else if (response.status >= 400 && response.status < 500 ){
        const error = response;
        return error
      } else {
        const error = response;
        return error;
      }
    })
  })

}