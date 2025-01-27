
document.addEventListener('submit', async (event) => {
  event.preventDefault();
  try {
  const data = new FormData(event.target);
  console.log(data.getAll('exception-name'))
  const response = fetch('../interface-tier/*.php', {
    method: 'POST',
    body: formData
  });

  if (response.status >= 200 && response.status < 400) {
    const result = response.json();

  } else if (response.status >= 400 && response.status < 500 ){
    const error = await response.json();
    console.error('message', error);
  } else {
    const error = await response.json();
    console.error('message', error);
  }
  } catch (err) {
    console.error(err)
  }
})