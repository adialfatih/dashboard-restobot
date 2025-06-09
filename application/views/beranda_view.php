        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li>Dashboard</li>
                    </ul>
                </div>
                <div class="page-actions">
                    <button onclick="openModal('modalLarge')"><i class="fas fa-plus"></i> Add New</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="card-grid">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Total Revenue</div>
                            <div class="card-value">$24,780</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> 12.5% from last month
                            </div>
                        </div>
                        <div class="card-icon blue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">New Users</div>
                            <div class="card-value">1,254</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> 8.3% from last month
                            </div>
                        </div>
                        <div class="card-icon green">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Pending Orders</div>
                            <div class="card-value">56</div>
                            <div class="card-change negative">
                                <i class="fas fa-arrow-down"></i> 2.1% from last month
                            </div>
                        </div>
                        <div class="card-icon orange">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Support Tickets</div>
                            <div class="card-value">18</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> 5.7% from last month
                            </div>
                        </div>
                        <div class="card-icon pink">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-container">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-0001</td>
                            <td>John Doe</td>
                            <td>2023-06-15</td>
                            <td>$125.99</td>
                            <td><span class="status active">Completed</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0002</td>
                            <td>Jane Smith</td>
                            <td>2023-06-14</td>
                            <td>$89.50</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0003</td>
                            <td>Robert Johnson</td>
                            <td>2023-06-13</td>
                            <td>$245.75</td>
                            <td><span class="status active">Completed</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0004</td>
                            <td>Emily Davis</td>
                            <td>2023-06-12</td>
                            <td>$67.30</td>
                            <td><span class="status inactive">Cancelled</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-0005</td>
                            <td>Michael Wilson</td>
                            <td>2023-06-11</td>
                            <td>$189.99</td>
                            <td><span class="status pending">Processing</span></td>
                            <td>
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <!-- Small Modal -->
    <div id="modalSmall" class="modal">
        <div class="modal-dialog modal-small">
            <button class="modal-close" onclick="closeModal('modalSmall')">&times;</button>
            <h4>Small Modal</h4>
            <p>Ini konten untuk modal kecil.</p>
        </div>
    </div>

    <!-- Medium Modal -->
    <div id="modalMedium" class="modal">
        <div class="modal-dialog modal-medium">
            <button class="modal-close" onclick="closeModal('modalMedium')">&times;</button>
            <h4>Medium Modal</h4>
            <p>Ini konten untuk modal sedang.</p>
        </div>
    </div>

    <!-- Large Modal -->
    <div id="modalLarge" class="modal">
        <div class="modal-dialog modal-large">
            <button class="modal-close" onclick="closeModal('modalLarge')">&times;</button>
            <h4>Large Modal</h4>
            <p>Ini konten untuk modal besar.</p>
        </div>
    </div>

    