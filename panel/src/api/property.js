import * as ApiManager from './_manager';

export const property = {
  create: (payload = null) => {
    return ApiManager.callApi(
      `/admin/property/create`,
      payload
    );
  },

  get: (payload = null) => {
    return ApiManager.callApi(
      `/admin/property/get`,
      payload
    );
  },

  list: payload => {
    return ApiManager.callApi(
      `/admin/property/list`,
      payload
    );
  },

  delete: payload => {
    return ApiManager.callApi(
      `/admin/property/${payload.id}/delete`,
      payload
    );
  },

  update: payload => {
    return ApiManager.callApi(
      `/admin/property/` +
        payload.id +
        `/update`,
      payload
    );
  },
};
