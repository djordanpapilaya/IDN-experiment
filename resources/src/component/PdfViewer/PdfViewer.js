import { AbstractTransitionComponent } from 'vue-transition-component';
import VuePdfApp from "vue-pdf-app";
import VueTypes from 'vue-types';
import "vue-pdf-app/dist/icons/main.css";
import PdfViewerTransitionController from './PdfViewerTransitionController';

// @vue/component
export default {
  name: 'PdfViewer',
  extends: AbstractTransitionComponent,
  props: {
    data: VueTypes.any.isRequired,
  },
  watch: {
    currentPage(newValue, oldValue) {
      this.trackPage(newValue);
    }
  },
  data() {
    return {
      info: [],
      pdfApp: [],
      currentPage: 1,
      interval: null,
      config: {
        sidebar: {
          viewThumbnail: false,
          viewOutline: false,
          viewAttachments: false,
        },
        secondaryToolbar: {
          secondaryPresentationMode: false,
          secondaryOpenFile: false,
          secondaryPrint: false,
          secondaryDownload: false,
          secondaryViewBookmark: false,
          firstPage: false,
          lastPage: false,
          pageRotateCw: false,
          pageRotateCcw: false,
          cursorSelectTool: false,
          cursorHandTool: false,
          scrollVertical: false,
          scrollHorizontal: false,
          scrollWrapped: false,
          spreadNone: false,
          spreadOdd: false,
          spreadEven: false,
          documentProperties: false,
        },
        toolbar: {
          toolbarViewerLeft: {
            findbar: false,
          },
          toolbarViewerRight: {
            presentationMode: false,
            openFile: false,
            print: false,
            download: false,
            viewBookmark: false,
          },
        }
      }
    };

  },
  components: {
    VuePdfApp,
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new PdfViewerTransitionController(this);
      this.isReady();
      this.trackPage(1);
    },
    afterCreatedHandler(pdfApp) {
      // this.pdfApp is non-reactive because it is not in data
      // for typescript use class { pdfApp?: unknown }
      this.interval = setInterval(() => {
        this.pdfApp = pdfApp;
        this.currentPage = this.pdfApp.page
        // console.log(this.pdfApp.page);
      }, 1000);
    },
    trackPage(newPage) {
      console.log('TRACK_PAGE_VIEW', newPage);
    },
  },
  beforeDestroy() {
    clearInterval(this.interval);
  },
};
