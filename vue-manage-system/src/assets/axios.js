import axios from 'axios'
// import store from "../store";

function send(...arr) {
  let url = arr[1];
  url = url.replace(/(^\/?api)/g, ''); // eslint-disable-line
  url = url.replace(/(^\/?)/g, ''); // eslint-disable-line
  return new Promise((resolve, reject) => {
    axios({
      method: arr[0],
      url: 'http://blog.backend.com/api/' + url,
      params: arr[2]
    }).then(res => {
      resolve(res)
    })
  })
}

const request = {
  get: (url, params) => send('get', url, params),
  put: (url, body, options) => send('put', url, body, options),
  post: (url, body, options) => send('post', url, body, options),
  delete: (url, body, options) => send('delete', url, body, options),
};

export default request;
