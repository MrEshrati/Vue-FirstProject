import { useAuthStore } from './../stores/auth-store';
import { boot } from 'quasar/wrappers'

export default boot(
  async ({urlPath,redirect}) => {

    const auth = useAuthStore();
    auth.import();

    if (urlPath.includes('dashboard') && !urlPath.includes('login')){

      if (!auth.isAuthorized){

        redirect({name:'login'});
        return;
      }
    } else if(urlPath.includes('login')){

      if (auth.isAuthorized){

        redirect({name:'dashboard'});
        return;
      }
    }

});
