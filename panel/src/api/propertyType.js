import * as ApiManager from './_manager';

export const propertyType = {
  list: payload => {
    return ApiManager.callApi(
      `/admin/propertyType/list`,
      payload
    );
  },
}