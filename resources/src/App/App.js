import { DeviceStateEvent } from 'seng-device-state-tracker';
import { mapMutations, mapState } from 'vuex';
import { FlowManager, AbstractRegistrableComponent } from 'vue-transition-component';
import { SET_DEVICE_STATE, SET_RESOURCES, SET_TIME, SET_USER_DATA, SET_GUIDE_WATCHED } from '../store/module/app/app';
import { RouteNames } from '../router/routes';
import MainHeader from '../component/MainHeader';
import MainFooter from '../component/MainFooter';
import Guide from '../component/Guide';
import InactiveWindow from '../component/InactiveWindow';
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
      inactiveWindow: false,
      inactiveTimer: 0,
    };
  },
  components: {
    MainHeader,
    MainFooter,
    Guide,
    InactiveWindow,
  },
  created() {
    this.$deviceStateTracker.addEventListener(
      DeviceStateEvent.STATE_UPDATE,
      this.handleDeviceStateUpdate,
    );
    this.setDeviceState(this.$deviceStateTracker.currentState);

    this.initResources();
    this.initTimer();
    this.initInactive();

    document.addEventListener("mousemove", this.handleActive, false);
    document.addEventListener("mousedown", this.handleActive, false);
    document.addEventListener("keypress", this.handleActive, false);
    document.addEventListener("touchmove", this.handleActive, false);
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

      this.startTimer();

      gateway.get('user/session/update').then(() => {
      });
    },
    startTimer() {
      const gateway = getValue(GATEWAY);

      this.sessionInterval = setInterval(() => {
        gateway.get('user/session/update').then(() => {
        });
      }, 60000);

      gateway.get('user/session').then((result) => {
        this.setTime(result.data);
      });
    },
    pauseTimer() {
      clearInterval(this.sessionInterval);
      this.$refs.header.$refs.timer.pauseTimer();
    },
    playTimer() {
      this.startTimer();
      this.$refs.header.$refs.timer.playTimer();
    },
    initInactive() {
      this.inactiveTimer = setTimeout(() => {
        this.handleInactive();
      }, 5 * 60 * 1000);
    },
    handleInactive() {
      this.inactiveWindow = true;
      this.pauseTimer();
    },
    handleActive() {
      clearTimeout(this.inactiveTimer);
      this.initInactive();
    },
    handleInactiveCancel() {
      this.inactiveWindow = false;
      this.playTimer();
    }
  },
};
