<!DOCTYPE html>
<html lang="hi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Products - IndiaSales</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
  <style>
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }
    .hero-gradient {
      background: linear-gradient(135deg, #6366f1, #a855f7);
    }
    button:focus{
      outline:unset;
    }
  </style>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Top Navigation -->
  <nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-indigo-600">LoanHub</h1>
      <div class="flex items-center gap-4">
        <input type="text" placeholder="Search loans..." 
               class="px-4 py-2 border rounded-lg w-80 focus:outline-none focus:border-indigo-500">
        <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
          Apply Restriction
        </button>
      </div>
    </div>
  </nav>

  <!-- Hero Banner -->
  <div class="hero-gradient text-white py-8">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
      <div>
        <h2 class="text-3xl font-bold">Get the best loan offers for your customer</h2>
        <p class="mt-2 text-lg opacity-90">Instant Personal Loans • Zero Hidden Charges</p>
      </div>
      <div class="flex gap-3">
        <button class="bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl hover:bg-white/30">
          Copy Link
        </button>
        <button class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold hover:bg-gray-100">
          Check Offers
        </button>
      </div>
    </div>
  </div>

  <!-- Product Grid -->
  <div class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-semibold mb-8 text-gray-800">Personal Loan Products</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="productGrid">
      <!-- Cards will be added by JS -->
    </div>
  </div>

  <!-- Product Detail Modal -->
  <div id="detailModal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50" style="z-index: 999;"> 
        <div class="bg-white rounded-2xl w-full max-w-6xl max-h-[95vh] overflow-hidden shadow-2xl">
      <div class="p-6 border-b flex justify-between items-center">
        <h2 id="modalTitle" class="text-2xl font-bold mb-0"></h2>
        <button onclick="closeModal()" class="text-3xl text-gray-400 hover:text-gray-600">×</button>
      </div>
      
      <div class="p-6 space-y-6 overflow-auto" style="max-height: calc(90vh - 140px);">
        <div id="modalContent">
          <!-- Dynamic content -->
        </div>
      </div>

      <div class="p-6 border-t flex gap-4">
        <button onclick="copy()" 
                class="flex-1 py-4 border border-gray-300 rounded-xl font-medium">
          Copy Link
        </button>
        <button onclick="sellNow()" 
                class="flex-1 py-4 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700">
          Sell Now
        </button>
      </div>
    </div>
  </div>

  <script>
    const products = [
      {
        name: "Poonawalla Fincorp Personal Loan",
        logo: "💰",
        amount: "₹5 Lakhs",
        benefit: "Instant Approval",
        desc: "Get Instant Personal Loan Online Upto ₹5 Lakhs with quick approval and zero hidden charges."
      },
      {
        name: "Zype Personal Loan",
        logo: "⚡",
        amount: "₹10 Lakhs",
        benefit: "Fast Disbursal",
        desc: "Quick and hassle-free personal loan with minimal documentation."
      },
      {
        name: "PrefR Personal Loan",
        logo: "🌟",
        amount: "₹7 Lakhs",
        benefit: "Low Interest",
        desc: "Best in class interest rates with collateral-free loan."
      },
      {
        name: "Moneyview Personal Loan",
        logo: "📱",
        amount: "₹5 Lakhs",
        benefit: "100% Online",
        desc: "Instant personal loan with 100% digital process."
      }
      // Add more products as needed
    ];

    // Render Product Cards
    function renderProducts() {
      const grid = document.getElementById('productGrid');
      grid.innerHTML = '';

      products.forEach(product => {
        const card = document.createElement('div');
        card.className = `bg-white rounded-2xl p-6 card-hover cursor-pointer border border-gray-100`;
        card.innerHTML = `
          <div class="text-5xl mb-4">${product.logo}</div>
          <h3 class="font-semibold text-lg mb-1">${product.name}</h3>
          <p class="text-emerald-600 font-medium">${product.amount}</p>
          <p class="text-sm text-gray-500 mt-2">${product.benefit}</p>
          <button onclick="showDetail('${product.name}', '${product.desc}', '${product.amount}')" 
                  class="mt-6 w-full py-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-xl font-medium">
            View Details
          </button>
        `;
        grid.appendChild(card);
      });
    }

    function showDetail(name, desc, amount) {
      document.getElementById('modalTitle').textContent = name;
      document.getElementById('modalContent').innerHTML = `
       <!-- Header -->
    <div class="flex justify-between items-start border-b pb-3">

        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-xl bg-indigo-100 flex items-center justify-center text-3xl">
                💰
            </div>

            <div>
                <h2 class="text-3xl font-bold">${name}</h2>

                <span class="inline-block mt-2 px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm">
                    Personal Loan
                </span>
            </div>
        </div>

        

    </div>
        <div class="space-y-6 py-3">
          <div class="text-6xl">${amount}</div>
          <p class="text-gray-600 leading-relaxed">${desc}</p>
          
          <div class="grid grid-cols-2 gap-4 text-sm">
            <div class="bg-gray-50 p-4 rounded-xl">
              <p class="text-gray-500">Quick Approval</p>
              <p class="font-medium">Within 30 minutes</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl">
              <p class="text-gray-500">Zero Charges</p>
              <p class="font-medium">No hidden fees</p>
            </div>
          </div>
        </div>
        <div class="space-y-6">

   


    <!-- Tabs -->

    <div class="border-b mt-3">

        <div class="flex gap-8">

            <button class="tab-btn border-b-2 border-indigo-600 text-indigo-600 pb-3 font-semibold"
                onclick="changeTab('benefits',this)">
                Product Benefits
            </button>

            <button class="tab-btn pb-3 text-gray-500"
                onclick="changeTab('works',this)">
                How It Works?
            </button>

            <button class="tab-btn pb-3 text-gray-500"
                onclick="changeTab('terms',this)">
                Terms & Conditions
            </button>

            <button class="tab-btn pb-3 text-gray-500"
                onclick="changeTab('sell',this)">
                Whom To Sell
            </button>

        </div>

    </div>


    <!-- TAB CONTENT -->

    <div id="tabContent" class="bg-white rounded-2xl border p-8 min-h-[350px]">

        <div id="benefits">

            <ul class="space-y-5 text-lg">

                <li>✅ Get Instant Personal Loan upto ₹5 Lakhs</li>

                <li>✅ Quick Approval</li>

                <li>✅ 100% Online Process</li>

                <li>✅ Zero Hidden Charges</li>

                <li>✅ Collateral Free</li>

                <li>✅ Minimal Documentation</li>

                <li>✅ No Foreclosure Charges</li>

            </ul>

        </div>

    </div>

</div>
      `;
      document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('detailModal').classList.add('hidden');
    }

    function sellNow() {
      alert("✅ Sell Now button clicked! (Integrate your backend here)");
      closeModal();
    }

    // Initialize
    renderProducts();
    function changeTab(type, el){

    document.querySelectorAll(".tab-btn").forEach(btn=>{
        btn.classList.remove("border-b-2","border-indigo-600","text-indigo-600","font-semibold");
        btn.classList.add("text-gray-500");
    });

    el.classList.add("border-b-2","border-indigo-600","text-indigo-600","font-semibold");

    let html="";

    if(type=="benefits"){

        html=`
        <ul class="space-y-5 text-lg">

            <li>✅ Get Instant Personal Loan upto ₹5 Lakhs</li>

            <li>✅ Quick Approval</li>

            <li>✅ 100% Online Application</li>

            <li>✅ Zero Hidden Charges</li>

            <li>✅ Collateral Free</li>

            <li>✅ Minimal Documentation</li>

            <li>✅ No Foreclosure Charges</li>

        </ul>`;
    }

    if(type=="works"){

        html=`
        <div class="space-y-6">

            <div class="flex gap-4">

                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                    1
                </div>

                <div>
                    Apply Online
                </div>

            </div>

            <div class="flex gap-4">

                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                    2
                </div>

                <div>
                    Upload Documents
                </div>

            </div>

            <div class="flex gap-4">

                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                    3
                </div>

                <div>
                    Get Approval & Disbursal
                </div>

            </div>

        </div>`;
    }

    if(type=="terms"){

        html=`
        <ul class="list-disc ml-5 space-y-3">

            <li>Minimum Age : 21 Years</li>

            <li>Maximum Age : 58 Years</li>

            <li>Indian Resident</li>

            <li>Monthly Income Required</li>

        </ul>`;
    }

    if(type=="sell"){

        html=`
        <div class="grid grid-cols-2 gap-5">

            <div class="border rounded-xl p-5">

                Salaried Employee

            </div>

            <div class="border rounded-xl p-5">

                Self Employed

            </div>

            <div class="border rounded-xl p-5">

                Business Owner

            </div>

            <div class="border rounded-xl p-5">

                Professionals

            </div>

        </div>`;
    }

    document.getElementById("tabContent").innerHTML=html;

}
  </script>
</body>
</html>