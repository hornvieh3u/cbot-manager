import './app-bar-search'
import './apps/user-list'
import './jwt'
import mock from './mock'
import './pages/faq'
import './pages/help-center'
import './pages/profile'

// Apps
import './apps/calendar'
import './apps/chat'
import './apps/email'
import './apps/invoice'

// Dashboard
import './dashboard/analytics'

// forwards the matched request over network
mock.onAny().passThrough()
