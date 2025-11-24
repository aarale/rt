<div className="min-h-screen bg-white">
  {/* NAVBAR */}
  <nav className="bg-blue-900 text-white px-6 py-4 shadow-md">
    <div className="flex items-center gap-4">
      <div className="bg-blue-600 p-2 rounded-lg">
        💬
      </div>
      <div>
        <h1 className="text-xl font-semibold">Chat por Pedido</h1>
        <p className="text-blue-200 text-sm">Conversaciones agrupadas por orden</p>
      </div>
    </div>
  </nav>

  <div className="container mx-auto px-4 py-8 max-w-6xl grid grid-cols-1 md:grid-cols-3 gap-6">
    
    {/* LISTA DE CONVERSACIONES */}
    <div className="border border-gray-300 rounded-lg shadow-md overflow-hidden">
      <div className="bg-blue-100 p-4 font-semibold text-blue-900 border-b">Conversaciones</div>
      <div className="divide-y divide-gray-200">
        {/* Conversación */}
        <button className="w-full text-left p-4 hover:bg-blue-50 transition-all border-l-4 border-blue-600 bg-blue-100">
          <div className="flex justify-between items-start mb-1">
            <div className="flex gap-2 items-center">
              <div className="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">C</div>
              <span className="text-gray-900 font-medium">Cesar Bernal (Café Central)</span>
            </div>
            <span className="text-xs bg-blue-600 text-white px-2 py-0.5 rounded-full">1</span>
          </div>
          <p className="text-sm text-gray-600 truncate ml-12">Sí, puedes pasar por él en 5 minutos 😊</p>
          <p className="ml-12 text-blue-600 text-xs mt-1 flex items-center gap-1">📦 Pedido #101</p>
        </button>

        <button className="w-full text-left p-4 hover:bg-blue-50 transition-all">
          <div className="flex justify-between items-start mb-1">
            <div className="flex gap-2 items-center">
              <div className="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">J</div>
              <span className="text-gray-900 font-medium">Jorge González (TechStore)</span>
            </div>
            <span className="text-xs bg-blue-600 text-white px-2 py-0.5 rounded-full">1</span>
          </div>
          <p className="text-sm text-gray-600 truncate ml-12">¿Tienes stock disponible?</p>
          <p className="ml-12 text-blue-600 text-xs mt-1 flex items-center gap-1">📦 Pedido #202</p>
        </button>
      </div>
    </div>

    {/* PANTALLA DE CHAT */}
    <div className="col-span-2 border border-blue-600 rounded-lg shadow-md flex flex-col">
      {/* HEADER CHAT */}
      <div className="bg-blue-50 border-b-2 border-blue-600 p-4">
        <div className="flex flex-col">
          <span className="text-gray-800 font-medium text-lg flex items-center gap-2">👤 Cesar Bernal (Café Central)</span>
          <span className="text-blue-600 text-sm mt-1 flex items-center gap-1">📦 Pedido #101</span>
        </div>
      </div>

      {/* MENSAJES */}
      <div className="flex-1 overflow-y-auto bg-gray-50 p-4 space-y-3">
        {/* Mensaje recibido */}
        <div className="flex justify-start">
          <div className="max-w-xs bg-white border border-gray-200 p-3 rounded-lg shadow">
            <p className="text-sm">Hola, ¿mi pedido ya está listo?</p>
            <span className="text-xs text-gray-500 mt-1 flex items-center gap-1">🕒 10:35</span>
          </div>
        </div>

        {/* Mensaje enviado */}
        <div className="flex justify-end">
          <div className="max-w-xs bg-blue-600 text-white p-3 rounded-lg shadow">
            <p className="text-sm">Sí, puedes pasar por él en 5 minutos 😊</p>
            <span className="text-xs text-blue-200 mt-1 flex items-center gap-1">🕒 10:36</span>
          </div>
        </div>
      </div>

      {/* INPUT */}
      <div className="p-4 border-t-2 border-blue-600 bg-white">
        <div className="flex gap-2">
          <input
            type="text"
            placeholder="💬 Escribe un mensaje..."
            className="w-full border-2 border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
          />
          <button className="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Enviar</button>
        </div>
      </div>
    </div>
  </div>
</div>
