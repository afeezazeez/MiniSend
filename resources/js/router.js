import Home from './Home'
import Email from './components/Email'
import RecipientEmails from './components/RecipientEmails'
import SendEmail from './components/SendEmail'
import NotFound from './components/NotFound'

export default {
    mode:'history',
    routes:[
        {path: '*',component: NotFound},
        {path: '/', component:Home,name: 'home'},
        {path: '/data-view/emails/:id', component:Email,name:'email.show'},
        {path: '/data-view/emails/recipient/:email', component:RecipientEmails,name:'recipient.emails'},
        {path: '/emails/send', component:SendEmail,name:'emails.send'}
    ]

}
