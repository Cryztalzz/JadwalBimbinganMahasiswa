<template>
  <div class="calendar-container">
    <div class="calendar">
      <div class="calendar-header">
        <button @click="previousMonth">&lt;</button>
        <h2>{{ currentMonthName }} {{ currentYear }}</h2>
        <button @click="nextMonth">&gt;</button>
      </div>
      <div class="calendar-grid">
        <div class="weekday" v-for="day in weekDays" :key="day">{{ day }}</div>
        <div
          v-for="day in calendarDays"
          :key="day.date"
          :class="['calendar-day', { 'has-event': hasEvent(day.date) }]"
          @click="showEventDetails(day.date)"
        >
          {{ day.day }}
        </div>
      </div>
    </div>
    <div class="event-sidebar" v-if="selectedDate">
      <h3>Jadwal untuk {{ formatDate(selectedDate) }}</h3>
      <div v-if="getEventsForDate(selectedDate).length > 0">
        <div v-for="event in getEventsForDate(selectedDate)" :key="event.id" class="event-item">
          <h4>{{ event.title }}</h4>
          <p>{{ event.time }}</p>
          <p>{{ event.description }}</p>
        </div>
      </div>
      <p v-else>Tidak ada jadwal untuk tanggal ini</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentDate: new Date(),
      selectedDate: null,
      weekDays: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
      events: [
        {
          id: 1,
          date: '2024-03-15',
          title: 'Bimbingan Skripsi',
          time: '09:00 - 10:00',
          description: 'Bimbingan dengan Dosen Pembimbing'
        },
        {
          id: 2,
          date: '2024-03-18',
          title: 'Seminar Proposal',
          time: '13:00 - 15:00',
          description: 'Presentasi proposal skripsi'
        }
      ]
    }
  },
  computed: {
    currentMonthName() {
      return this.currentDate.toLocaleString('id-ID', { month: 'long' })
    },
    currentYear() {
      return this.currentDate.getFullYear()
    },
    calendarDays() {
      const year = this.currentDate.getFullYear()
      const month = this.currentDate.getMonth()
      const firstDay = new Date(year, month, 1)
      const lastDay = new Date(year, month + 1, 0)
      const days = []

      // Tambahkan hari kosong untuk mengisi awal bulan
      for (let i = 0; i < firstDay.getDay(); i++) {
        days.push({ day: '', date: null })
      }

      // Tambahkan hari-hari dalam bulan
      for (let i = 1; i <= lastDay.getDate(); i++) {
        const date = new Date(year, month, i)
        days.push({
          day: i,
          date: date.toISOString().split('T')[0]
        })
      }

      return days
    }
  },
  methods: {
    previousMonth() {
      this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1)
    },
    nextMonth() {
      this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1)
    },
    hasEvent(date) {
      return this.events.some(event => event.date === date)
    },
    getEventsForDate(date) {
      return this.events.filter(event => event.date === date)
    },
    showEventDetails(date) {
      this.selectedDate = date
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      })
    }
  }
}
</script>

<style scoped>
.calendar-container {
  display: flex;
  gap: 2rem;
  padding: 1rem;
}

.calendar {
  flex: 1;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1rem;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.calendar-header button {
  background: #4a5568;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
}

.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 0.5rem;
}

.weekday {
  text-align: center;
  font-weight: bold;
  padding: 0.5rem;
}

.calendar-day {
  aspect-ratio: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #e2e8f0;
  border-radius: 4px;
  cursor: pointer;
}

.calendar-day:hover {
  background: #f7fafc;
}

.has-event {
  background: #ebf8ff;
  color: #2b6cb0;
  font-weight: bold;
}

.event-sidebar {
  width: 300px;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1rem;
}

.event-item {
  margin-bottom: 1rem;
  padding: 0.5rem;
  border: 1px solid #e2e8f0;
  border-radius: 4px;
}

.event-item h4 {
  margin: 0 0 0.5rem 0;
  color: #2d3748;
}

.event-item p {
  margin: 0.25rem 0;
  color: #4a5568;
}
</style> 