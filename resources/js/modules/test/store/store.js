import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        tests: [],
        testsMeta: [],
        testsLoading: true,
    },
    getters: {
        tests: state => state.tests,
        testsMeta: state => state.testsMeta,
        testsLoading: state => state.testsLoading,
    },
    mutations: {
        [types.TEST_OBTAIN](state, tests) {
            state.tests = tests
        },
        [types.TEST_CLEAR](state) {
            state.tests = []
        },
        [types.TEST_SET_LOADING](state, loading) {
            state.testsLoading = loading
        },
        [types.TEST_META](state, meta) {
            state.testsMeta = meta
        },
    },
    actions
}
