import Dashboard from './components/Dashboard.vue'
import Customer from './pages/customer/Customer.vue'
import PurchaseOrder from './pages/purchaseorder/PurchaseOrder.vue'
import sku from './pages/sku/sku.vue'
export default[
    {
        path: '/dashboard',
        name : 'dashboard',
        component: Dashboard
    },
    {
        path: '/customer',
        name : 'customer',
        component: Customer
    },
    {
        path: '/purchaseorder',
        name : 'purchaseorder',
        component: PurchaseOrder
    },
    {
        path: '/sku',
        name : 'sku',
        component: sku
    }
]