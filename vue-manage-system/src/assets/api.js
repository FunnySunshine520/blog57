import request from './axios';

let $api = {
  login: (params) => {
    return request.post('/api/login', params)
  },
  testget: (params) => {
    return request.get('/test', params)
  }
  // musicUrl: (params) => {
  //   return $get('/music/url', params)
  // },
  // banner: (params) => {
  //   return $get('/banner', params)
  // },
  // personalized: (params) => {
  //   return $get('/personalized', params)
  // },
  // personalizedMv: (params) => {
  //   return $get('/personalized/mv', params)
  // },
  // search: (params) => {
  //   return $get('/search', params)
  // },
  // searchHot: (params) => {
  //   return $get('/search/hot', params)
  // },
}
export default $api;