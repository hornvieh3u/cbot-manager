import axios from 'axios'

const app = createApp({});

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  // baseURL: 'http://localhost:3000/',
  timeout: 1000,
  headers: { 'X-Custom-Header': 'foobar' },
})

app.config.globalProperties.$http = axiosIns

export default axiosIns
