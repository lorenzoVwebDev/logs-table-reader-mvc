import "https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js";
export function downloadLogFile(type) {
 document.querySelector(`.${type}-download-button`).addEventListener('click', async (event) => {
  console.log('hello')
  const blob = await fetch(`http://logs-table-reader-mvc/public/download/downloadlogs/${type}?type=${type}`).then((response) => response.blob());
  const url = window.URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = `${dayjs().format('DDMMYY')}error_logs.log`;
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  window.URL.revokeObjectURL(url);
 })
}


/* fetch(`http://logs-table-reader-mvc/public/download/downloadlogs/exception?potato=4&carrot=5/`, {
  headers: {
    "Content-Type": "application/json"
  }
}).then(response => response.json());

 */