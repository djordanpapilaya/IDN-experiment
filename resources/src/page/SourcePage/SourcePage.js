import { AbstractPageTransitionComponent } from 'vue-transition-component';
import moment from 'moment';
import SourcePageTransitionController from './SourcePageTransitionController';
import SourceHeader from '../../component/SourceHeader';
import AudioPlayer from '../../component/AudioPlayer';
import VideoPlayer from '../../component/VideoPlayer';
import PdfViewer from '../../component/PdfViewer';
import { getValue } from '../../util/injector';
import { GATEWAY } from '../../data/Injectables';
import { mapMutations } from 'vuex';
import { SET_RESOURCE, SET_RESOURCES } from '../../store/module/app/app';

// @vue/component
export default {
  name: 'SourcePage',
  extends: AbstractPageTransitionComponent,
  data() {
    return {
      resourceLoaded: false,
      data: null,
      startTime: 0,
      endTime: 0,
    };
  },
  components: {
    SourceHeader,
    AudioPlayer,
    VideoPlayer,
    PdfViewer,
  },
  created() {
    this.loadResource();
  },
  methods: {
    ...mapMutations({
      setResource: SET_RESOURCE,
      setResources: SET_RESOURCES,
    }),
    handleAllComponentsReady() {
      this.transitionController = new SourcePageTransitionController(this);
      this.isReady();
      this.startTime = moment().format('YYYY-MM-DD HH:mm:ss');
    },
    loadResource() {
      const gateway = getValue(GATEWAY);
      const path = this.$route.params.name;

      gateway.get('resource/' + path).then((result) => {
        this.setResource(result.data);
        this.data = result.data;
      }).then(() => {
        this.resourceLoaded = true;
        this.trackResource();
      });
    },
    trackResource() {
      const gateway = getValue(GATEWAY);
      const id = this.data.id;

      gateway.post('event/route', {
        'resource_id': id,
      }).then(() => {
        console.log('TRACK_SOURCE', id);
        this.loadNewResourceList();
      });
    },
    loadNewResourceList() {
      const gateway = getValue(GATEWAY);

      gateway.get('resources').then((result) => {
        this.setResources(result.data);
      });
    }
  },
  beforeRouteLeave (to, from , next) {
    this.endTime = moment().format('YYYY-MM-DD HH:mm:ss');
    const gateway = getValue(GATEWAY);
    const id = this.data.id;

    gateway.post('event/time', {
      'resource_id': id,
      'time_started': this.startTime,
      'time_ended': this.endTime,
    }).then(() => {
      next();
    });
  }
};
