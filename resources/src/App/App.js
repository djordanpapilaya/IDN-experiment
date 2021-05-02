import { DeviceStateEvent } from 'seng-device-state-tracker';
import { mapMutations, mapState } from 'vuex';
import { FlowManager, AbstractRegistrableComponent } from 'vue-transition-component';
import { SET_DEVICE_STATE, SET_RESOURCES, SET_TIME, SET_USER_DATA, SET_GUIDE_WATCHED } from '../store/module/app/app';
import { RouteNames } from '../router/routes';
import MainHeader from '../component/MainHeader';
import MainFooter from '../component/MainFooter';
import Guide from '../component/Guide';
import { GATEWAY } from '../data/Injectables';
import { getValue } from '../util/injector';

// @vue/component
export default {
  name: 'App',
  computed: {
    ...mapState({
      deviceState: (state) => state.app.deviceState,
      userData: (state) => state.app.userData,
      guideWatched: (state) => state.app.guideWatched,
    }),
  },
  data() {
    return {
      resourcesLoaded: false,
      sessionInterval: null,
      userDataAvailable: false,
      guide: false,
    };
  },
  components: {
    MainHeader,
    MainFooter,
    Guide,
  },
  created() {
    this.$deviceStateTracker.addEventListener(
      DeviceStateEvent.STATE_UPDATE,
      this.handleDeviceStateUpdate,
    );
    this.setDeviceState(this.$deviceStateTracker.currentState);

    this.initResources();
    this.initTimer();
  },
  methods: {
    ...mapMutations({
      setDeviceState: SET_DEVICE_STATE,
      setResources: SET_RESOURCES,
      setTime: SET_TIME,
      setUserData: SET_USER_DATA,
      setGuideWatched: SET_GUIDE_WATCHED,
    }),
    handleDeviceStateUpdate(event) {
      this.setDeviceState(event.data.state);
    },
    onLeave(element, done) {
      FlowManager.transitionOut.then(() => FlowManager.done()).then(done);
    },
    initResources() {
      const gateway = getValue(GATEWAY);

      gateway.get('resources').then((result) => {
        this.setResources(result.data);
      }).then(() => {
        this.resourcesLoaded = true;
      });

      gateway.get('user').then((result) => {
        this.setUserData(result.data);
      }).then(() => {
        this.userDataAvailable = true;
        this.guide = this.userData.firstSession;
        this.setGuideWatched(!this.userData.firstSession);
      });
    },
    initTimer() {
      const gateway = getValue(GATEWAY);

      gateway.get('user/session/update').then(() => {
      });

      this.sessionInterval = setInterval(() => {
        gateway.get('user/session/update').then(() => {
        });
      }, 60000);

      gateway.get('user/session').then((result) => {
        this.setTime(result.data);
      });
    },
  },
};
