const namespace = 'app';

export const SET_DEVICE_STATE = `${namespace}/setDeviceState`;
export const SET_RESOURCES = `${namespace}/setResources`;
export const SET_RESOURCE = `${namespace}/setResource`;

export default {
  state: {
    deviceState: null,
    resources: null,
    resource: null,
  },
  getters: {},
  mutations: {
    [SET_DEVICE_STATE](state, deviceState) {
      state.deviceState = deviceState;
    },
    [SET_RESOURCES](state, resources) {
      state.resources = resources;
    },
    [SET_RESOURCE](state, resource) {
      state.resource = resource;
    },
  },
  actions: {},
};
