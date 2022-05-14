import PageList from './components/TestList'
import PageView from './components/TestView'
import TestList from '@/modules/test/components/TestList'
import TestView from '@/modules/test/components/TestView'

export const routes = [
    {
        path: '/tests',
        name: 'Tests',
        component: TestList,
    },
    {
        path: '/tests/:id',
        name: 'Show Test',
        component: TestView,
        hidden: true
    },
]
