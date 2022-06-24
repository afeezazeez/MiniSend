import Home from './Home'
import Email from './components/Email'

export default {
    model:'history',
    routes:[
        {path: '/', component:Home},
        {path: '/data-view/emails', component:Email},
    ],
    mode:'history'
}
