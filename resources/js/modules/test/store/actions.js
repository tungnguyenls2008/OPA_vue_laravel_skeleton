import * as types from './types'
import testApi from '../api'

export const actions = {
    async [types.TEST_FETCH]({commit}, data = null) {
        commit(types.TEST_SET_LOADING, true)
        const response = await testApi.all(data)
        commit(types.TEST_OBTAIN, response.data.data)
        commit(types.TEST_META, response.data.meta)
        commit(types.TEST_SET_LOADING, false)
    },
}
